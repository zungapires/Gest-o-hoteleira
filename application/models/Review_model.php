<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model {
    protected $file = 'reviews.json';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        return readJson($this->file);
    }
}
