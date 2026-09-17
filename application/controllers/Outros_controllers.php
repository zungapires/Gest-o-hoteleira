<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outros_controllers extends CI_Controller {
    public function __construct(){ parent::__construct(); }

    public function clientes()
    {
        $this->load->view('clientes/index');
    }

    public function checkin()
    {
        $this->load->view('checkin/index');
    }

    public function pagamentos()
    {
        $this->load->view('pagamentos/index');
    }

    public function relatorios()
    {
        $this->load->view('relatorios/index');
    }
}
