<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->model('Review_model');
        $this->load->model('Hotel_model');
    }

    public function index()
    {
        $data = [
            'rooms' => $this->Room_model->all(),
            'reviews' => $this->Review_model->all(),
            'hotels' => $this->Hotel_model->all(),
            'user' => $this->authUser
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('frontend/home', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function search()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('/');
        }

        $checkIn = $this->input->post('check_in');
        $checkOut = $this->input->post('check_out');
        $guests = (int) $this->input->post('guests');
        $type = $this->input->post('type');

        $rooms = $this->Room_model->all();
        $available = array_filter($rooms, function ($room) use ($guests, $type, $checkIn, $checkOut) {
            if ($type && stripos($room['type'], $type) === false) {
                return false;
            }
            if ($room['capacity'] < $guests) {
                return false;
            }
            return $this->Room_model->isAvailableForDates($room, $checkIn, $checkOut);
        });

        $data = array_values($available);
        $this->output->set_content_type('application/json')->set_output(json_encode(['success' => true, 'rooms' => $data]));
    }

    public function rooms_listing()
    {
        $data = [
            'rooms' => $this->Room_model->all(),
            'user' => $this->authUser
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('frontend/rooms', $data);
        $this->load->view('layouts/footer', $data);
    }
}
