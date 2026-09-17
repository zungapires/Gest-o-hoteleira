<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Room_model');
    }

    public function servicos() {
        $data['page_title'] = 'Nossos Serviços';
        $this->load->view('frontend/servicos', $data);
    }

    public function contacto() {
        $data['page_title'] = 'Contacte-Nos';
        $this->load->view('frontend/contacto', $data);
    }

    public function galeria() {
        $data['page_title'] = 'Galeria de Imagens';
        $this->load->view('frontend/galeria', $data);
    }

    public function quartos() {
        $this->load->model('Room_model');
        $data['rooms'] = $this->Room_model->all();
        $data['page_title'] = 'Nossos Quartos';
        $this->load->view('quartos/index', $data);
    }
}
?>
