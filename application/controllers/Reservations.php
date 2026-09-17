<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reservation_model');
        $this->load->model('Room_model');
        $this->load->model('Payment_model');
        $this->load->model('User_model');
    }

    // Admin: confirm reservation (AJAX)
    public function confirm_ajax($id)
    {
        $this->requireAdmin();
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
            return;
        }
        $reservation = $this->Reservation_model->find($id);
        if (!$reservation) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }
        $this->Reservation_model->update($id, ['status' => 'confirmed']);
        // mark room as occupied
        $this->Room_model->update($reservation['room_id'], ['status' => 'unavailable']);
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true]));
    }

    // Admin: cancel reservation (AJAX)
    public function cancel_ajax($id)
    {
        $this->requireAdmin();
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
            return;
        }
        $reservation = $this->Reservation_model->find($id);
        if (!$reservation) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }
        $this->Reservation_model->update($id, ['status' => 'cancelled']);
        // free the room
        $this->Room_model->update($reservation['room_id'], ['status' => 'available']);
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true]));
    }

    // Admin: generate PDF and send confirmation email to guest (AJAX)
    public function send_pdf_ajax($id)
    {
        $this->requireAdmin();
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
            return;
        }
        $reservation = $this->Reservation_model->find($id);
        if (!$reservation) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }

        $sent = $this->sendReservationConfirmationEmail($reservation);
        if (!$sent) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Falha ao enviar e-mail de confirmação.']));
            return;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true]));
    }

    public function invoice($reservationId)
    {
        $reservation = $this->Reservation_model->find($reservationId);
        if (!$reservation) {
            show_error('Reserva não encontrada.', 404);
            return;
        }

        if ($this->authUser) {
            if ($this->authUser['role'] !== 'admin' && $reservation['user_id'] !== 0 && $reservation['user_id'] !== $this->authUser['id']) {
                show_error('Acesso negado.', 403);
                return;
            }
        } elseif ($reservation['user_id'] !== 0) {
            redirect('login');
            return;
        }

        $filename = 'reservation_' . $reservationId . '.pdf';
        $filePath = FCPATH . 'storage/invoices/' . $filename;
        if (!file_exists($filePath)) {
            show_error('Arquivo de nota não encontrado.', 404);
            return;
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        readfile($filePath);
        exit;
    }

    protected function sendReservationConfirmationEmail($reservation)
    {
        $room = $this->Room_model->find($reservation['room_id']);
        if (!$room) {
            return false;
        }

        $checkIn = new DateTime($reservation['check_in']);
        $checkOut = new DateTime($reservation['check_out']);
        $nights = $checkIn->diff($checkOut)->days;
        $hotelLocation = 'Av. Central, 123 - Centro, Sua Cidade';
        $roomNumber = isset($room['name']) ? $room['name'] : 'Quarto #' . $reservation['room_id'];

        $this->load->library('Pdf_library');
        $pdfData = [
            'reservation' => $reservation,
            'room' => $room,
            'nights' => $nights,
            'hotel_location' => $hotelLocation,
            'room_number' => $roomNumber
        ];
        $html = $this->load->view('emails/reservation_pdf', $pdfData, true);
        $filename = 'reservation_' . $reservation['id'] . '.pdf';
        $pdfPath = $this->pdf_library->generate($html, $filename);

        $this->load->library('email');
        $this->email->initialize(['mailtype' => 'html', 'charset' => 'utf-8']);
        $fromEmail = getenv('EMAIL_FROM') ?: 'no-reply@hotel.local';
        $fromName = getenv('EMAIL_FROM_NAME') ?: 'Hotel';
        $this->email->from($fromEmail, $fromName);

        $to = !empty($reservation['guest_email']) ? $reservation['guest_email'] : null;
        if (!$to) {
            return false;
        }

        $this->email->to($to);
        $this->email->subject('Confirmação de Reserva #' . $reservation['id']);
        $message = $this->load->view('emails/reservation_email', ['reservation' => $reservation, 'room' => $room], true);
        $this->email->message($message);
        if ($pdfPath && file_exists($pdfPath)) {
            $this->email->attach($pdfPath);
        }

        return (bool) $this->email->send();
    }

    protected function sendReservationConfirmationSms($reservation)
    {
        $phone = !empty($reservation['guest_phone']) ? preg_replace('/[^0-9+]/', '', $reservation['guest_phone']) : null;
        $accountSid = getenv('TWILIO_ACCOUNT_SID');
        $authToken = getenv('TWILIO_AUTH_TOKEN');
        $fromNumber = getenv('TWILIO_PHONE_NUMBER');

        if (!$phone || !$accountSid || !$authToken || !$fromNumber) {
            return false;
        }

        $message = sprintf(
            "Sua reserva #%s foi recebida. Check-in: %s, Check-out: %s. Total: MT %s.",
            $reservation['reservation_code'] ?? $reservation['id'],
            $reservation['check_in'],
            $reservation['check_out'],
            number_format($reservation['total'], 2, ',', '.')
        );

        $payload = [
            'From' => $fromNumber,
            'To' => $phone,
            'Body' => $message
        ];

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
        return $this->sendHttpPost($url, $payload, $accountSid, $authToken);
    }

    protected function sendReservationConfirmationWhatsApp($reservation)
    {
        $phone = !empty($reservation['guest_phone']) ? preg_replace('/[^0-9+]/', '', $reservation['guest_phone']) : null;
        $accountSid = getenv('TWILIO_ACCOUNT_SID');
        $authToken = getenv('TWILIO_AUTH_TOKEN');
        $whatsappFrom = getenv('TWILIO_WHATSAPP_NUMBER');

        if (!$phone || !$accountSid || !$authToken || !$whatsappFrom) {
            return false;
        }

        $body = sprintf(
            "Sua reserva #%s foi recebida. Check-in: %s, Check-out: %s. Total: MT %s.",
            $reservation['reservation_code'] ?? $reservation['id'],
            $reservation['check_in'],
            $reservation['check_out'],
            number_format($reservation['total'], 2, ',', '.')
        );

        $payload = [
            'From' => 'whatsapp:' . ltrim($whatsappFrom, '+'),
            'To' => 'whatsapp:' . ltrim($phone, '+'),
            'Body' => $body
        ];

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";
        return $this->sendHttpPost($url, $payload, $accountSid, $authToken);
    }

    protected function sendHttpPost($url, $data, $user = null, $pass = null)
    {
        if (!function_exists('curl_init')) {
            return false;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        if ($user && $pass) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 300;
    }

    public function index()
    {
        $this->requireAdmin();
        $reservations = $this->Reservation_model->all();
        $rooms = $this->Room_model->all();
        $data = [
            'user' => $this->authUser,
            'reservations' => $reservations,
            'rooms' => $rooms
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/reservations', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $rooms = $this->Room_model->all();
        $data = [
            'user' => $this->authUser,
            'rooms' => $rooms
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('frontend/reservation', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function book()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('/');
            return;
        }
        $guestName = trim($this->input->post('guest_name', true));
        $guestEmail = trim($this->input->post('guest_email', true));
        $guestPhone = trim($this->input->post('guest_phone', true));
        $guestDocument = trim($this->input->post('guest_document', true));
        $checkIn = $this->input->post('check_in', true);
        $checkOut = $this->input->post('check_out', true);
        $arrivalTime = $this->input->post('arrival_time', true);
        $guests = (int) $this->input->post('guests', true);
        $type = $this->input->post('type', true);
        $pickup = $this->input->post('pickup', true) === 'yes' ? 'yes' : 'no';
        $specialRequests = trim($this->input->post('special_requests', true));

        if (empty($guestName) || empty($guestEmail) || empty($checkIn) || empty($checkOut) || empty($arrivalTime) || empty($type) || $guests < 1) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos obrigatórios.']));
            return;
        }

        if (!filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'O e-mail informado não é válido.']));
            return;
        }

        $rooms = $this->Room_model->all();
        $availableRooms = array_filter($rooms, function ($room) use ($type, $guests, $checkIn, $checkOut) {
            if ($room['capacity'] < $guests) {
                return false;
            }
            if ($type && stripos($room['type'], $type) === false) {
                return false;
            }
            return $this->Room_model->isAvailableForDates($room, $checkIn, $checkOut);
        });

        if (empty($availableRooms)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Nenhum quarto disponível corresponde à sua busca.']));
            return;
        }

        $room = reset($availableRooms);
        $start = new DateTime($checkIn);
        $end = new DateTime($checkOut);
        $nights = $start->diff($end)->days;

        if ($nights <= 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'A data de check-out deve ser posterior à data de check-in.']));
            return;
        }

        $total = $room['price'] * $nights;
        $clientId = $this->authUser ? $this->authUser['id'] : 0;

        if ($clientId === 0) {
            $existingUser = $this->User_model->findByEmail($guestEmail);
            if ($existingUser) {
                $clientId = $existingUser['id'];
            }
        }

        $reservation = [
            'user_id' => $clientId,
            'guest_name' => $guestName,
            'guest_email' => $guestEmail,
            'guest_phone' => $guestPhone,
            'guest_document' => $guestDocument,
            'room_id' => $room['id'],
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'arrival_time' => $arrivalTime,
            'guests' => $guests,
            'pickup' => $pickup,
            'special_requests' => $specialRequests,
            'status' => 'pending',
            'payment_status' => 'pending',
            'total' => $total,
            'type' => $room['type']
        ];

        $reservation = $this->Reservation_model->create($reservation);
        $this->Room_model->update($room['id'], ['status' => 'reserved']);
        $this->Payment_model->create([
            'reservation_id' => $reservation['id'],
            'amount' => $total,
            'status' => 'pending'
        ]);

        $emailSent = $this->sendReservationConfirmationEmail($reservation);
        $smsSent = $this->sendReservationConfirmationSms($reservation);
        $whatsappSent = $this->sendReservationConfirmationWhatsApp($reservation);

        $channels = [];
        if ($emailSent) $channels[] = 'e-mail';
        if ($smsSent) $channels[] = 'SMS';
        if ($whatsappSent) $channels[] = 'WhatsApp';

        $this->logNotificationAttempt($reservation['id'], [
            'email' => $emailSent,
            'sms' => $smsSent,
            'whatsapp' => $whatsappSent,
            'guest_email' => $guestEmail,
            'guest_phone' => $guestPhone
        ]);

        $message = 'Reserva enviada com sucesso.';
        if (!empty($channels)) {
            $message .= ' Confirmação enviada por ' . implode(', ', $channels) . '.';
        } else {
            $message .= ' A confirmação será enviada assim que possível.';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode([
            'success' => true,
            'message' => $message,
            'reservation_id' => $reservation['id'],
            'reservation_code' => isset($reservation['reservation_code']) ? $reservation['reservation_code'] : null,
            'email_sent' => $emailSent,
            'sms_sent' => $smsSent,
            'whatsapp_sent' => $whatsappSent
        ]));
    }

    protected function logNotificationAttempt($reservationId, $results)
    {
        $logPath = FCPATH . 'storage/notifications.log';
        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'reservation_id' => $reservationId,
            'results' => $results
        ];

        $logLine = '[' . $entry['timestamp'] . '] reservation_id=' . $reservationId . ' email=' . ($results['email'] ? 'ok' : 'fail') . ' sms=' . ($results['sms'] ? 'ok' : 'fail') . ' whatsapp=' . ($results['whatsapp'] ? 'ok' : 'fail') . ' guest_email=' . $results['guest_email'] . ' guest_phone=' . $results['guest_phone'] . PHP_EOL;
        file_put_contents($logPath, $logLine, FILE_APPEND | LOCK_EX);
    }

    public function lookup()
    {
        $data = ['user' => $this->authUser];
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('frontend/lookup', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function lookup_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('/');
            return;
        }

        $code = trim($this->input->post('reservation_code', true));
        $email = trim($this->input->post('email', true));
        if (empty($code) || empty($email)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Preencha o código e o email.']));
            return;
        }

        $reservations = $this->Reservation_model->all();
        $found = null;
        foreach ($reservations as $r) {
            if (isset($r['reservation_code']) && strcasecmp($r['reservation_code'], $code) === 0) {
                // match by reservation code and email
                $rEmail = isset($r['guest_email']) ? $r['guest_email'] : null;
                if ($rEmail && strcasecmp($rEmail, $email) === 0) {
                    $found = $r;
                    break;
                }
                // if user_id present and user email matches
                if (isset($r['user_id']) && $r['user_id']) {
                    $this->load->model('User_model');
                    $user = $this->User_model->find($r['user_id']);
                    if ($user && isset($user['email']) && strcasecmp($user['email'], $email) === 0) {
                        $found = $r;
                        break;
                    }
                }
            }
        }

        if (!$found) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true, 'reservation' => $found]));
    }

    public function cancel_public_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('/');
            return;
        }

        $id = $this->input->post('id', true);
        $code = trim($this->input->post('reservation_code', true));
        $email = trim($this->input->post('email', true));

        if (empty($id) || empty($code) || empty($email)) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Dados insuficientes.']));
            return;
        }

        $reservation = $this->Reservation_model->find($id);
        if (!$reservation) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }

        if (!isset($reservation['reservation_code']) || strcasecmp($reservation['reservation_code'], $code) !== 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Código inválido.']));
            return;
        }

        $rEmail = isset($reservation['guest_email']) ? $reservation['guest_email'] : null;
        if (!$rEmail || strcasecmp($rEmail, $email) !== 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Email não corresponde à reserva.']));
            return;
        }

        if (isset($reservation['status']) && $reservation['status'] === 'cancelled') {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva já está cancelada.']));
            return;
        }

        // perform cancel and release room
        $this->Reservation_model->update($id, ['status' => 'cancelled']);
        if (isset($reservation['room_id'])) {
            $this->Room_model->update($reservation['room_id'], ['status' => 'available']);
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true, 'message' => 'Reserva cancelada com sucesso.']));
    }

    public function checkout($reservationId)
    {
        $reservation = $this->Reservation_model->find($reservationId);
        if (!$reservation) {
            show_error('Reserva não encontrada.', 404);
            return;
        }

        if ($this->authUser) {
            if ($reservation['user_id'] !== 0 && $reservation['user_id'] !== $this->authUser['id']) {
                show_error('Reserva não encontrada ou acesso negado.', 404);
                return;
            }
        } elseif ($reservation['user_id'] !== 0) {
            redirect('login');
            return;
        }

        $payment = $this->Payment_model->findByReservationId($reservationId);
        $room = $this->Room_model->find($reservation['room_id']);

        $data = [
            'user' => $this->authUser,
            'reservation' => $reservation,
            'payment' => $payment,
            'room' => $room,
            'requires_email' => !$this->authUser && $reservation['user_id'] === 0
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('payments/checkout', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function process_payment_ajax($reservationId)
    {
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
            return;
        }

        $reservation = $this->Reservation_model->find($reservationId);
        if (!$reservation) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada.']));
            return;
        }

        if ($this->authUser) {
            if ($reservation['user_id'] !== 0 && $reservation['user_id'] !== $this->authUser['id']) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Reserva não encontrada ou acesso negado.']));
                return;
            }
        } elseif ($reservation['user_id'] !== 0) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Faça login para continuar.']));
            return;
        } else {
            $input = json_decode($this->input->raw_input_stream, true);
            $guestEmail = isset($input['guest_email']) ? trim($input['guest_email']) : null;
            if (!$guestEmail || !filter_var($guestEmail, FILTER_VALIDATE_EMAIL) || strcasecmp($guestEmail, $reservation['guest_email']) !== 0) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Email não corresponde à reserva.']));
                return;
            }
        }

        $payment = $this->Payment_model->findByReservationId($reservationId);
        if (!$payment) {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Pagamento não encontrado.']));
            return;
        }

        if ($payment['status'] === 'paid') {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Pagamento já foi efetuado.']));
            return;
        }

        if ($reservation['status'] === 'cancelled') {
            $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Não é possível pagar uma reserva cancelada.']));
            return;
        }

        $this->Payment_model->update($payment['id'], ['status' => 'paid']);
        $this->Reservation_model->update($reservationId, ['payment_status' => 'paid', 'status' => 'confirmed']);
        $this->Room_model->update($reservation['room_id'], ['status' => 'unavailable']);

        $emailSent = $this->sendReservationConfirmationEmail($reservation);
        $responseMessage = $emailSent ? 'Pagamento efetuado com sucesso. Enviamos a confirmação para o seu e-mail.' : 'Pagamento efetuado com sucesso, mas não conseguimos enviar o e-mail de confirmação. Entre em contato com o suporte.';
        $redirectUrl = $this->authUser ? site_url('client/profile') : null;

        $this->output->set_content_type('application/json')->set_output(json_encode([
            'success' => true,
            'message' => $responseMessage,
            'email_sent' => $emailSent,
            'reservation_code' => $reservation['reservation_code'] ?? null,
            'redirect' => $redirectUrl,
            'reservation_id' => $reservationId
        ]));
    }
}
