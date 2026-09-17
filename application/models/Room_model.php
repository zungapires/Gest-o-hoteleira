<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {
    protected $file = 'rooms.json';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reservation_model');
    }

    public function all()
    {
        return readJson($this->file);
    }

    public function find($id)
    {
        $rooms = $this->all();
        foreach ($rooms as $room) {
            if ($room['id'] == $id) {
                return $room;
            }
        }
        return null;
    }

    public function create($data)
    {
        $rooms = $this->all();
        $data['id'] = getNextJsonId($rooms);
        if (!isset($data['blocked_periods']) || !is_array($data['blocked_periods'])) {
            $data['blocked_periods'] = [];
        }
        $rooms[] = $data;
        writeJson($this->file, $rooms);
        return $data;
    }

    public function update($id, $data)
    {
        if (isset($data['blocked_periods']) && !is_array($data['blocked_periods'])) {
            $data['blocked_periods'] = [];
        }
        return updateJson($this->file, $id, $data);
    }

    public function isAvailableForDates($room, $checkIn, $checkOut)
    {
        if (empty($room)) {
            return false;
        }

        if (empty($checkIn) || empty($checkOut)) {
            return false;
        }

        $start = new DateTime($checkIn);
        $end = new DateTime($checkOut);
        if ($start >= $end) {
            return false;
        }

        $reservations = $this->Reservation_model->all();
        foreach ($reservations as $reservation) {
            if (!isset($reservation['room_id']) || $reservation['room_id'] != $room['id']) {
                continue;
            }

            if (isset($reservation['status']) && $reservation['status'] === 'cancelled') {
                continue;
            }

            if (empty($reservation['check_in']) || empty($reservation['check_out'])) {
                continue;
            }

            $existingStart = new DateTime($reservation['check_in']);
            $existingEnd = new DateTime($reservation['check_out']);
            if ($this->rangesOverlap($start, $end, $existingStart, $existingEnd)) {
                return false;
            }
        }

        $blockedPeriods = isset($room['blocked_periods']) && is_array($room['blocked_periods']) ? $room['blocked_periods'] : [];
        foreach ($blockedPeriods as $block) {
            if (!isset($block['start_date'], $block['end_date'])) {
                continue;
            }
            if ($this->rangesOverlap($start, $end, new DateTime($block['start_date']), new DateTime($block['end_date']))) {
                return false;
            }
        }

        return true;
    }

    protected function rangesOverlap(DateTime $startA, DateTime $endA, DateTime $startB, DateTime $endB)
    {
        return $startA < $endB && $startB < $endA;
    }

    public function delete($id)
    {
        return deleteJson($this->file, $id);
    }
}
