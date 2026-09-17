<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas_Quartos extends CI_Controller {
    public function __construct(){ parent::__construct(); }

    public function index()
    {
        $this->load->view('reservas/index');
    }

    public function quartos()
    {
        $this->load->view('quartos/index');
    }
}
