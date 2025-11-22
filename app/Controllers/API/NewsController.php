<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\NewsModel;
use Exception;

class NewsController extends ResourceController
{
    protected $modelName = NewsModel::class;
    protected $format    = 'json';

    //GET/api/news
    public function index()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page    = $this->request->getGet('page') ?? 1;
        $orderBy = $this->request->getGet('orderBy') ?? "last_update";
        $direction    = $this->request->getGet('direction') ?? "desc";

        try {

            $keyword    = $this->request->getGet('search');
            if ($keyword) {
                $data = $this->model->search($perPage, $page, $orderBy, $direction, $keyword);
            } else {
                $data = $this->model->getcontent($perPage, $page, $orderBy, $direction);
            }

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get All News Successfully",
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
                "message" => "News with id $id Not Found"
            ], 404);
        }
        return $this->respond([
            "status" => "success",
            "message" => "Get News by ID Successfully",
            "data" => $data
        ], status: 200);
    }

    // GET /api/news/{path}
    public function byPath($path = null)
    {
        $data = $this->model->where("content_path", $path)->first();
        if (!$data) {
            return $this->respond([
                "status" => "failed",
                "message" => "News with path $path Not Found"
            ], 404);
        }
        return $this->respond([
            "status" => "success",
            "message" => "Get News by Path Successfully",
            "data" => $data
        ], status: 200);
    }

    // POST /api/News
    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'content_title' => 'required',
            'content_desc'  => 'required',
            'content_path'  => 'required'
        ];

        $date = date("Y-m-d");
        $data = [
            "content_title" => $data["content_title"],
            "content_desc" => $data["content_desc"],
            "content_path" => $data["content_path"],
            "is_news" => 1,
            "is_draft" => 0,
            "publish_date" => $date,
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
                "message" => "Create news Data Successfully",
                "data" => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    // PUT/PATCH /api/news
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $checkId = $this->model->find($id);

        if (!$checkId) {
            return $this->respond([
                "status" => "failed",
                "message" => "ID Not Found"
            ], 400);
        }

        try {
            $this->model->update($id, $data);
            return $this->respond([
                'status' => 'success',
                "message" => "Update news successfully",
                'data' => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                "message" => $error->getMessage(),
            ], 400);
        }
    }


    // DELETE /api/news{id}
    public function delete($id = null)
    {
        $checkId = $this->model->find($id);

        if (!$checkId) {
            return $this->respond([
                "status" => "failed",
                "message" => "ID Not Found"
            ], 400);
        }

        try {
            $this->model->delete($id);
            return $this->respondDeleted([
                'status' => 'success',
                "message" => "Delete news successfully",
                'id' => $id
            ], 204);
        } catch (Exception $error) {
            return $this->respondDeleted([
                'status' => 'failed',
                "message" => $error->getMessage(),
            ], 400);
        }
    }
}
