<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Reservation_model');
    }

    protected function assignGuestReservationsToUser($user)
    {
        $reservations = $this->Reservation_model->all();
        foreach ($reservations as $reservation) {
            if (empty($reservation['user_id']) || $reservation['user_id'] === 0) {
                if (!empty($reservation['guest_email']) && strcasecmp($reservation['guest_email'], $user['email']) === 0) {
                    $this->Reservation_model->update($reservation['id'], ['user_id' => $user['id']]);
                }
            }
        }
    }

    public function login()
    {
        if ($this->authUser) {
            redirect('/');
        }

        $data = ['error' => null, 'user' => $this->authUser];
        if ($this->input->post()) {
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $user = $this->User_model->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $this->assignGuestReservationsToUser($user);
                $this->session->set_userdata('user', $user);
                redirect($user['role'] === 'admin' ? 'admin' : 'client/profile');
                return;
            }
            $data['error'] = 'Credenciais inválidas. Tente novamente.';
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function register()
    {
        if ($this->authUser) {
            redirect('/');
        }

        $data = ['error' => null, 'user' => $this->authUser];
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Senha', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirmar senha', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $existing = $this->User_model->findByEmail($this->input->post('email', true));
                if ($existing) {
                    $data['error'] = 'O email já está em uso.';
                } else {
                    $newUser = [
                        'name' => $this->input->post('name', true),
                        'email' => $this->input->post('email', true),
                        'password' => $this->input->post('password', true),
                        'role' => 'client'
                    ];
                    $user = $this->User_model->create($newUser);
                    $this->assignGuestReservationsToUser($user);
                    $this->session->set_userdata('user', $user);
                    redirect('client/profile');
                    return;
                }
            }
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('/');
    }

    public function forgot()
    {
        $data = ['user' => $this->authUser];
        $this->load->view('layouts/header', $data);
        $this->load->view('auth/forgot', $data);
        $this->load->view('layouts/footer', $data);
    }
}
