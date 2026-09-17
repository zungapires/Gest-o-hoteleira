<?php
/**
 * Router script for PHP built-in web server.
 * Allows routing requests to index.php while serving static files directly.
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// If the file exists and is not a directory, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require_once __DIR__ . '/index.php';
