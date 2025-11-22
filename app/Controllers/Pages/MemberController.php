<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use function PHPSTORM_META\map;

class MemberController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Loan Management',
            'role' => 'member',
            'css' => 'member_loan_management.css'
        ];

        return view('pages/user/denda', $data);
    }

    public function peminjaman()
    {
        $data = [
            'title' => 'Peminjaman',
            'role' => 'member',
            'css' => 'member_loan_management.css'
        ];

        return view('pages/user/peminjaman', $data);
    }

    public function loan()
    {
        $data = [
            'title' => 'Peminjaman Mandiri',
            'role' => '',
            'css' => 'member_loan_management.css'
        ];

        return view('pages/user/peminjaman_mandiri/loan', $data);
    }

    public function accessDenied()
    {
        $data = [
            'title' => 'Access Denied',
            'role' => '',
            'css' => 'member_loan_management.css'
        ];
        return view('pages/user/peminjaman_mandiri/access_denied', $data);
    }
}
