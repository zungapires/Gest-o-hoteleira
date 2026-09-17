<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$protocol = getenv('EMAIL_PROTOCOL') ?: 'mail';
$protocol = in_array($protocol, ['smtp', 'mail', 'sendmail'], true) ? $protocol : 'mail';

$config['protocol'] = $protocol;
$config['smtp_host'] = getenv('SMTP_HOST') ?: '';
$config['smtp_user'] = getenv('SMTP_USER') ?: '';
$config['smtp_pass'] = getenv('SMTP_PASS') ?: '';
$config['smtp_port'] = getenv('SMTP_PORT') ?: 587;
$config['smtp_crypto'] = getenv('SMTP_CRYPTO') ?: 'tls';
$config['mailpath'] = getenv('SENDMAIL_PATH') ?: '/usr/sbin/sendmail -t -i';
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
$config['crlf']     = "\r\n";
$config['wordwrap'] = true;
$config['wrapchars'] = 76;
