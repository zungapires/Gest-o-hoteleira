<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jsondb {
    public function read($filename)
    {
        return readJson($filename);
    }

    public function write($filename, $data)
    {
        return writeJson($filename, $data);
    }

    public function update($filename, $id, $data)
    {
        return updateJson($filename, $id, $data);
    }

    public function delete($filename, $id)
    {
        return deleteJson($filename, $id);
    }

    public function getNextId($items)
    {
        return getNextJsonId($items);
    }
}
