<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function get_all(){ return $this->db->get('clientes')->result(); }
}

class Pagamento_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function get_all(){ return $this->db->get('pagamentos')->result(); }
}

class Checkin_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function get_all(){ return $this->db->get('checkins')->result(); }
}

class Log_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function write($data){ $this->db->insert('logs', $data); }
}

class Funcionario_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function get_all(){ return $this->db->get('funcionarios')->result(); }
}

class Servico_model extends CI_Model {
    public function __construct(){ parent::__construct(); }
    public function get_all(){ return $this->db->get('servicos')->result(); }
}
