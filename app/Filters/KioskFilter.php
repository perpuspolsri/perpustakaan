<?php

namespace App\Filters;

use App\Models\LandingPageContentModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class KioskFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = $request->getCookie('kiosk_token');

        if (!$token) {
            return redirect()->to('/member/dashboard');
        }

        $db = db_connect();
        $device = $db->table('kiosk_devices')
            ->where('token', $token)
            ->where('is_active', 1)
            ->get()
            ->getRow();

        if (!$device) {
            return redirect()->to('/member/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
