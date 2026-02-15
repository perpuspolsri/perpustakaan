<?php

namespace App\Controllers\API\Services;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KioskActivator extends BaseController
{
    public function activate()
    {
        setcookie(
            'kiosk_token',
            '92c251fe7c7bec0d292a070a7907430857d703a6d9901e8ba9bdd4a3650932c0',
            time() + (365 * 24 * 60 * 60),
            '/',
            '',
            false,   // Secure
            true    // HttpOnly
        );

        return 'Kiosk activated';
    }
}
