<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {
    protected $file = 'payments.json';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        return readJson($this->file);
    }

    public function create($data)
    {
        $payments = $this->all();
        $data['id'] = getNextJsonId($payments);
        $payments[] = $data;
        writeJson($this->file, $payments);
        return $data;
    }

    public function find($id)
    {
        $payments = $this->all();
        foreach ($payments as $payment) {
            if ($payment['id'] == $id) {
                return $payment;
            }
        }
        return null;
    }

    public function findByReservationId($reservationId)
    {
        $payments = $this->all();
        foreach ($payments as $payment) {
            if ($payment['reservation_id'] == $reservationId) {
                return $payment;
            }
        }
        return null;
    }

    public function update($id, $data)
    {
        return updateJson($this->file, $id, $data);
    }
}
