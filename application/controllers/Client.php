<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reservation_model');
        $this->load->model('Room_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->requireAdmin();
        $users = $this->User_model->all();
        $data = ['user' => $this->authUser, 'clients' => array_filter($users, function ($user) { return $user['role'] === 'client'; })];
        $this->load->view('layouts/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/clients', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function profile()
    {
        $this->requireLogin();
        $reservations = $this->Reservation_model->all();
        $rooms = $this->Room_model->all();
        $userReservations = array_filter($reservations, function ($reservation) {
            return $reservation['user_id'] === $this->authUser['id'];
        });
        $data = [
            'user' => $this->authUser,
            'reservations' => $userReservations,
            'rooms' => $rooms
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('client/profile', $data);
        $this->load->view('layouts/footer', $data);
    }
}
