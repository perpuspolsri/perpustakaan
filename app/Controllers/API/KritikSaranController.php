<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\KritikSaran;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\NewsModel;
use Exception;

class KritikSaranController extends ResourceController
{
    protected $modelName = KritikSaran::class;
    protected $format    = 'json';

    //GET/api/news
    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page    = $this->request->getGet('page') ?? 1;

        try {
            $data = $this->model->getKritikSaran($perPage, $page);

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get All Kritik Saran Successfully",
                "data" => $data,
                "pagination" => [
                    'currentPage' => $pager->getCurrentPage(),
                    'perPage'     => $pager->getPerPage(),
                    'total'       => $pager->getTotal(),
                    'pageCount'   => $pager->getPageCount(),
                    'nextPage'    => $pager->hasMore() ? $pager->getCurrentPage() + 1 : null,
                    'prevPage'    => ($pager->getCurrentPage() > 1) ? $pager->getCurrentPage() - 1 : null
                ]
            ], 200);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ], 400);
        }
    }

    // GET /api/news/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->respond([
                "status" => "failed",
                "message" => "Kritik Saran with id $id Not Found"
            ], 404);
        }
        return $this->respond([
            "status" => "success",
            "message" => "Get Kritik Saran by ID Successfully",
            "data" => $data
        ], status: 200);
    }

    // POST /api/News
    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'email' => 'required',
            'message'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "status" => "failed",
                "message" => $this->validator->getErrors()
            ], 400);
        }

        try {
            $this->model->insert($data);
            return $this->respond([
                "status" => "success",
                "message" => "Create Kritik Saran Data Successfully",
                "data" => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }
}
