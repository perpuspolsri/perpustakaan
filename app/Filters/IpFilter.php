<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class IpFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Daftar IP yang diizinkan
        $allowedIPs = [
            '10.35.3.150',
            "127.0.0.1",
            "::1"
        ];

        $clientIP = $request->getIPAddress();
        log_message('error', 'Client IP: ' . $request->getIPAddress());

        if (!in_array($clientIP, $allowedIPs)) {
            return redirect()->to("/member/access_denied");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // gak perlu apa-apa di sini
    }
}
