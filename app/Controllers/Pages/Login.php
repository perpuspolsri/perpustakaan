<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $role = session()->get('user_role');
            return $this->redirectToDashboard($role);
        }

        $data = [
            'title' => 'Login - UPT Perpustakaan POLSRI'
        ];

        return view('login', $data);
    }

    public function logout()
    {
        session()->destroy();

        return view('logout_redirect');
    }

    public function testSession()
    {
        return view('test_session');
    }

    private function redirectToDashboard($role)
    {
        if ($role === 'admin') {
            return redirect()->to('admin/fines-management');
        } else {
            return redirect()->to('member/dashboard');
        }
    }

    public function resetPassword()
    {
        return view('reset_password');
    }
}
