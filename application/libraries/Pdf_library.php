<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_library {
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function generate($html, $filename = 'document.pdf')
    {
        $outputPath = FCPATH . 'storage/invoices/';
        if (!is_dir($outputPath)) {
            @mkdir($outputPath, 0755, true);
        }

        $fullPath = $outputPath . $filename;

        // Load Composer classes if needed
        if (!class_exists('\Dompdf\Dompdf') && file_exists(FCPATH . 'vendor/autoload.php')) {
            require_once FCPATH . 'vendor/autoload.php';
        }

        // Try to use Dompdf if installed via Composer
        if (class_exists('\Dompdf\Dompdf')) {
            try {
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                file_put_contents($fullPath, $dompdf->output());
                return $fullPath;
            } catch (Exception $e) {
                return false;
            }
        }

        // Fallback: create a simple PDF using `wkhtmltopdf` if available
        $tmpHtml = tempnam(sys_get_temp_dir(), 'pdf') . '.html';
        file_put_contents($tmpHtml, $html);
        $cmd = 'which wkhtmltopdf >/dev/null 2>&1 && wkhtmltopdf ' . escapeshellarg($tmpHtml) . ' ' . escapeshellarg($fullPath);
        exec($cmd, $out, $rc);
        @unlink($tmpHtml);
        if ($rc === 0 && file_exists($fullPath)) {
            return $fullPath;
        }

        return false;
    }
}
