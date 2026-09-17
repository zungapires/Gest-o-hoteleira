<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends CI_Model {
    protected $file = 'reservations.json';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        return readJson($this->file);
    }

    public function find($id)
    {
        $reservations = $this->all();
        foreach ($reservations as $reservation) {
            if ($reservation['id'] == $id) {
                return $reservation;
            }
        }
        return null;
    }

    public function create($data)
    {
        $reservations = $this->all();
        $data['id'] = getNextJsonId($reservations);
        // Ensure user_id exists for compatibility with existing code (0 means guest)
        if (!isset($data['user_id'])) {
            $data['user_id'] = 0;
        }
        // Reservation code: RES-YYYY-XXX
        if (empty($data['reservation_code'])) {
            $year = date('Y');
            $seq = str_pad($data['id'], 3, '0', STR_PAD_LEFT);
            $data['reservation_code'] = 'RES-' . $year . '-' . $seq;
        }
        // Normalize optional guest fields
        if (!isset($data['guest_name'])) $data['guest_name'] = null;
        if (!isset($data['guest_email'])) $data['guest_email'] = null;
        if (!isset($data['guest_phone'])) $data['guest_phone'] = null;
        if (!isset($data['guest_document'])) $data['guest_document'] = null;

        $reservations[] = $data;
        writeJson($this->file, $reservations);
        return $data;
    }

    public function update($id, $data)
    {
        return updateJson($this->file, $id, $data);
    }

    public function delete($id)
    {
        return deleteJson($this->file, $id);
    }
}
