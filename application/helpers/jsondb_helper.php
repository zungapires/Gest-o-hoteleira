<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('jsondb_path')) {
    function jsondb_path($filename)
    {
        $path = FCPATH . 'storage/' . $filename;
        if (!file_exists($path)) {
            @file_put_contents($path, json_encode([], JSON_PRETTY_PRINT));
        }
        return $path;
    }
}

if (!function_exists('readJson')) {
    function readJson($filename)
    {
        $path = jsondb_path($filename);
        $content = @file_get_contents($path);
        $data = json_decode($content, true);
        return is_array($data) ? $data : [];
    }
}

if (!function_exists('writeJson')) {
    function writeJson($filename, $data)
    {
        $path = jsondb_path($filename);
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return @file_put_contents($path, $json, LOCK_EX) !== false;
    }
}

if (!function_exists('getNextJsonId')) {
    function getNextJsonId($items)
    {
        if (empty($items)) {
            return 1;
        }
        return max(array_column($items, 'id')) + 1;
    }
}

if (!function_exists('updateJson')) {
    function updateJson($filename, $id, $newData)
    {
        $items = readJson($filename);
        foreach ($items as &$item) {
            if (isset($item['id']) && $item['id'] == $id) {
                $item = array_merge($item, $newData);
                writeJson($filename, $items);
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('deleteJson')) {
    function deleteJson($filename, $id)
    {
        $items = readJson($filename);
        $filtered = array_filter($items, function ($item) use ($id) {
            return !isset($item['id']) || $item['id'] != $id;
        });
        return writeJson($filename, array_values($filtered));
    }
}
