<?php

namespace App\Filters;

use App\Helpers\JwtHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $helper = new JwtHelper();
        $header = $request->getHeaderLine('Authorization');
        if (!$header) {
            return Services::response()->setJSON([
                "status" => "failed",
                "message" => "Unauthorized"
            ])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $header);
        $userData = $helper->verify_jwt($token);

        if (!$userData) {
            return Services::response()->setJSON([
                "status" => "failed",
                "message" => "Invalid Token"
            ])->setStatusCode(401);
        }

        $request->userData = $userData;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
