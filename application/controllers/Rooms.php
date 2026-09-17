<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
        $this->load->model('Room_model');
    }

    public function index()
    {
        $data = [
            'user' => $this->authUser,
            'rooms' => $this->Room_model->all()
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/rooms', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function save_ajax()
    {
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
        }

        $blockedJson = $this->input->post('blocked_periods', true);
        $blockedPeriods = [];
        if (!empty($blockedJson)) {
            $decoded = json_decode($blockedJson, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $blockedPeriods = $decoded;
            }
        }

        $roomData = [
            'number' => $this->input->post('number', true),
            'name' => $this->input->post('name', true),
            'price' => (float) $this->input->post('price', true),
            'capacity' => (int) $this->input->post('capacity', true),
            'type' => $this->input->post('type', true),
            'status' => $this->input->post('status', true),
            'image' => $this->input->post('image', true),
            'description' => $this->input->post('description', true),
            'blocked_periods' => $blockedPeriods
        ];

        $roomId = $this->input->post('id', true);
        if ($roomId) {
            $updated = $this->Room_model->update($roomId, $roomData);
            $message = $updated ? 'Quarto atualizado com sucesso.' : 'Não foi possível atualizar o quarto.';
        } else {
            $this->Room_model->create($roomData);
            $message = 'Quarto adicionado com sucesso.';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true, 'message' => $message]));
    }

    public function delete_ajax($id)
    {
        if (!$this->input->is_ajax_request()) {
            show_error('Acesso inválido', 403);
        }
        $deleted = $this->Room_model->delete($id);
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => (bool) $deleted]));
    }
}
