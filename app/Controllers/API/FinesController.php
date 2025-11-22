<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class FinesController extends ResourceController
{
    protected $modelName = LoanModel::class;
    protected $format    = 'json';
    public function index()
    {
        // Testing Error
        error_log('Test header: ' . $this->request->getHeaderLine('Authorization'));
        log_message('debug', 'Test log_message');

        
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $orderBy = $this->request->getGet('orderBy') ?? "due_date";
        $direction = $this->request->getGet('direction') ?? "DESC";

        try {
            $keyword    = $this->request->getGet('search');
            if ($keyword) {
                $data = $this->model->search($perPage, $page, $orderBy, $direction, $keyword);
            } else {
                $data = $this->model->getAllFines($perPage, $page, $orderBy, $direction);
            }

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get All Fines Successfully",
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

    public function reminder()
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $orderBy = $this->request->getGet('orderBy') ?? "due_date";
        $direction = $this->request->getGet('direction') ?? "DESC";

        try {
            $keyword    = $this->request->getGet('search');
            if ($keyword) {
                $data = $this->model->search($perPage, $page, $orderBy, $direction, $keyword);
            } else {
                $data = $this->model->getAllFinesHmin($perPage, $page, $orderBy, $direction);
            }

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get All H-1 Overdues Successfully",
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

    public function done($id)
    {
        try {
            $this->model->setFineDone($id);
            return $this->respond([
                "status" => "success",
                "message" => "Successfully Set Done Fine with ID $id"
            ]);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ]);
        }
    }

    public function getByMemberId($memberId)
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = $this->request->getGet('page') ?? 1;

        try {
            $data = $this->model->getFinesByMemberId($perPage, $page, $memberId);

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get Member $memberId Fines Successfully",
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
}
