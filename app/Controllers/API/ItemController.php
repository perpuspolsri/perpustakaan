<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ItemController extends ResourceController
{
    protected $modelName = ItemModel::class;
    protected $format    = 'json';
    public function find($id)
    {
        try {
            $item = $this->model->getDetail($id);
            if(!$item) {
                return $this->respond([
                    "status" => "failed",
                    "message" => "Kode buku tidak ditemukan. Pastikan kode yang anda masukkan sudah benar."
                ], 400);
            }
            return $this->respond([
                "status" => "success",
                "message" => "Successfully Get Item Detail",
                "data"=> $item
            ]);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ], 400);
        }
    }
}
