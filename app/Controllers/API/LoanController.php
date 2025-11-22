<?php

namespace App\Controllers\API;

use App\Models\LoanModel;
use App\Models\MasterCollectionTypeModel;
use CodeIgniter\RESTful\ResourceController;
use DateTime;
use Exception;

class LoanController extends ResourceController
{
    protected $modelName = LoanModel::class;
    protected $format    = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'item_code'  => 'required',
            'member_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "status" => "failed",
                "message" => $this->validator->getErrors()
            ], 400);
        }

        try {
            $date = new DateTime();
            $data = [
                "item_code" => $data["item_code"],
                "member_id" => $data["member_id"],
                "loan_date" => $date->format("Y-m-d"),
                "due_date" => $date->modify("+7 days")->format("Y-m-d"),
                "renewed" => 0,
                "loan_rules_id" => 1,
                "is_lent" => 1,
                "is_return" => 0,
                "uid" => 1
            ];

            if (!$this->model->insert($data)) {
                return $this->failValidationErrors($this->model->errors());
            }
            return $this->respond([
                "status" => "success",
                "message" => "Successfully Create New Loan",
                "data" => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    public function getByMemberId($memberId)
    {
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = $this->request->getGet('page') ?? 1;

        try {
            $data = $this->model->getLoansByMemberId($perPage, $page, $memberId);

            $pager = $this->model->pager;

            return $this->respond([
                "status" => "success",
                "message" => "Get Member $memberId Loans Successfully",
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
