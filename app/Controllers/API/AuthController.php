<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Helpers\JwtHelper;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use APP\Helpers;
use App\Models\MemberModel;
use DateTime;

class AuthController extends ResourceController
{

    public function login()
    {
        try {
            $helper = new JwtHelper();

            $json = $this->request->getJSON();
            $memberId = $json->member_id ?? '';
            $password = $json->password ?? '';

            $memberModel = new MemberModel();
            $member = $memberModel->where("member_id", $memberId)->first();

            if (!$member) {
                return $this->respond([
                    "status" => "failed",
                    "message" => "Invalid Member ID"
                ], 400);
            }

            if ($memberId === $member['member_id'] && password_verify($password, $member['mpasswd'])) {
                $token = $helper->create_jwt([
                    'member_id' => $member['member_id'],
                ]);

                session()->set([
                    'isLoggedIn' => true,
                    'realname' => $member['member_name'],
                    'user_image' => $member['member_image'],
                    'member_id' => $member['member_id'],
                    'user_role' => 'member'
                ]);

                return $this->respond([
                    'status' => 'success',
                    'token' => $token
                ], 200);
            }

            return $this->respond([
                "status" => "failed",
                "message" => "Invalid Password"
            ], 400);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function register()
    {
        try {
            $date = date('Y-m-d');

            $json = $this->request->getJSON(true);
            $memberId = $json["member_id"];
            $memberName = $json["member_name"] ?? '';
            $birthDate = $json["birth_date"] ?? '';
            $membershipType = 1;
            $gender = $json["gender"] ?? '';
            $email = $json["member_email"] ?? '';
            $phoneNumber = $json["member_phone"] ?? '';
            $password = $json["password"] ?? '';
            $confirmPassword = $json["confirm_password"] ?? '';
            $memberSince = $date;
            $registerDate = $date;

            $npmYear = "20" . substr($memberId, 2, 2) . "-12-31";
            $date = new DateTime($npmYear);
            $date->modify("+4 Years");;
            $expiryDate = $date->format("Y-m-d");

            $memberModel = new MemberModel();
            $existingMember = $memberModel->where("member_id", $memberId)->first();
            if($existingMember) {
                return $this->respond([
                    "status" => "failed",
                    "message" => "Member ID was existing"
                ], 400);
            }

            if($password != $confirmPassword) {
                return $this->respond([
                    "status" => "failed",
                    "message" => "Confirm password is not same with password"
                ], 400);
            }

            $member = $memberModel->insert([
                "member_id" => $memberId,
                "member_name" => $memberName,
                "birth_date" => $birthDate,
                "gender" => $gender,
                "member_type_id" => $membershipType,
                "member_email" => $email,
                "member_phone" => $phoneNumber,
                "mpasswd" => password_hash($password, PASSWORD_BCRYPT),
                "member_since_date" => $memberSince,
                "register_date" => $registerDate,
                "expire_date" => $expiryDate
            ]);

            return $this->respond([
                "status" => "success",
                "message" => "Successfully create new member"
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function adminLogin()
    {
        try {
            $helper = new JwtHelper();

            $json = $this->request->getJSON();
            $username = $json->username ?? '';
            $password = $json->password ?? '';

            $userModel = new UserModel();
            $user = $userModel->where("username", $username)->first();

            if (!$user) {
                return $this->respond([
                    "status" => "failed",
                    "message" => "Invalid Username"
                ], 400);
            }

            if ($username === $user['username'] && password_verify($password, $user['passwd'])) {
                $token = $helper->create_admin_jwt([
                    'id' => $user['user_id'],
                    'username' => $user['username']
                ]);

                session()->set([
                    'isLoggedIn' => true,
                    'realname' => $user['realname'],
                    'user_image' => $user['user_image'],
                    'user_role' => 'admin'
                ]);

                return $this->respond([
                    'status' => 'success',
                    'token' => $token
                ], 200);
            }

            return $this->respond([
                "status" => "failed",
                "message" => "Invalid Password"
            ], 400);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                'error' => $error->getMessage()
            ], 400);
        }
    }
}
