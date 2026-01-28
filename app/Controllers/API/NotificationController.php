<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\NewsModel;
use Exception;

class NotificationController extends ResourceController
{
    protected $modelName = LoanModel::class;
    protected $format    = 'json';

    public function getHP()
    {
        $apiKey = $this->request->getHeaderLine('Authorization');
        if($apiKey !== "Bearer " . getenv('GATEWAY_API_KEY')) {
            return $this->respond([
                'status' => "failed",
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        // Testing Error
        error_log('Test header: ' . $this->request->getHeaderLine('Authorization'));
        log_message('debug', 'Test log_message');

        try {
            $data = $this->model->getAllFinesCronHP("due_date", "ASC");

            return $this->respond($data, 200);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ], 400);
        }
    }

    public function getH()
    {
        $apiKey = $this->request->getHeaderLine('Authorization');
        if($apiKey !== "Bearer " . getenv('GATEWAY_API_KEY')) {
            return $this->respond([
                'status' => "failed",
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        // Testing Error
        error_log('Test header: ' . $this->request->getHeaderLine('Authorization'));
        log_message('debug', 'Test log_message');

        try {
            $data = $this->model->getAllFinesCronH("due_date", "ASC");

            return $this->respond($data, 200);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ], 400);
        }
    }
    public function getHM()
    {
        $apiKey = $this->request->getHeaderLine('Authorization');
        if($apiKey !== "Bearer " . getenv('GATEWAY_API_KEY')) {
            return $this->respond([
                'status' => "failed",
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }
        // Testing Error
        error_log('Test header: ' . $this->request->getHeaderLine('Authorization'));
        log_message('debug', 'Test log_message');

        try {
            $data = $this->model->getAllFinesCronHM("due_date", "ASC");

            return $this->respond($data, 200);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ], 400);
        }
    }
}
