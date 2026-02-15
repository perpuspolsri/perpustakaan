<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LoanController extends BaseController
{
    public function login()
    {
        return view("pages/loan/login");
    }
}
