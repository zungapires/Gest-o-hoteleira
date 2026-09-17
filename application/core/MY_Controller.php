<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $authUser = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->authUser = $this->session->userdata('user');
    }

    protected function requireLogin()
    {
        if (!$this->authUser) {
            redirect('login');
        }
    }

    protected function requireAdmin()
    {
        $this->requireLogin();
        if ($this->authUser['role'] !== 'admin') {
            redirect('login');
        }
    }
}
