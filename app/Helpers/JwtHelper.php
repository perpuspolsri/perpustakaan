<?php

namespace App\Helpers;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    public function create_jwt($data)
    {
        $key = getenv('JWT_SECRET');
        $issuedAt = time();
        $expire = $issuedAt + getenv('JWT_EXPIRE');

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
    public function create_admin_jwt($data)
    {
        $key = getenv('JWT_SECRET_ADMIN');
        $issuedAt = time();
        $expire = $issuedAt + getenv('JWT_EXPIRE');

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public function verify_jwt($token)
    {
        $key = getenv('JWT_SECRET');
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }

    public function verify_admin_jwt($token)
    {
        $key = getenv('JWT_SECRET_ADMIN');
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }
}
