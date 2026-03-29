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

    public function index()
    {
        return view("pages/loan/pages/index");
    }

    public function add()
    {
        return view("pages/loan/pages/confirm");
    }

    public function result()
    {
        return view("pages/loan/pages/result");
    }
}
