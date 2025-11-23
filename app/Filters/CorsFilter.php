<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CorsFilter implements FilterInterface
{
    // DOMAIN yang diizinkan
    private $allowedOrigins = [
        'https://perpustakaan.polsri.ac.id',
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        // Kalau origin ada dan tidak di allowed list → tolak
        if ($origin && !in_array($origin, $this->allowedOrigins)) {
            return service('response')
                ->setStatusCode(403)
                ->setJSON(['error' => 'Forbidden - Origin not allowed']);
        }

        // Set CORS header hanya utk origin yg valid
        if ($origin && in_array($origin, $this->allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        }

        header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

        // Request OPTIONS → langsung OK
        if ($request->getMethod() === 'options') {
            exit;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
