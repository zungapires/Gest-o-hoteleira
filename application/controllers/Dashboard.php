<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->requireAdmin();
        $this->load->model('User_model');
        $this->load->model('Room_model');
        $this->load->model('Reservation_model');
    }

    public function index()
    {
        $users = $this->User_model->all();
        $rooms = $this->Room_model->all();
        $reservations = $this->Reservation_model->all();
        $revenue = array_sum(array_column($reservations, 'total'));

        $data = [
            'user' => $this->authUser,
            'stats' => [
                'reservations' => count($reservations),
                'clients' => count(array_filter($users, function ($user) { return $user['role'] === 'client'; })),
                'rooms' => count($rooms),
                'revenue' => $revenue
            ],
            'rooms' => $rooms,
            'reservations_list' => $reservations
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/footer', $data);
    }
}
