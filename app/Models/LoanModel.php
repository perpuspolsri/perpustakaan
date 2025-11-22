<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table            = 'loan';
    protected $primaryKey       = 'loan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'input_date';
    protected $updatedField  = 'last_update';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllFines($perPage, $page, $orderBy, $direction)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, member.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date, DATEDIFF(CURDATE(), loan.due_date) AS 'days_total', (DATEDIFF(CURDATE(), loan.due_date) * mst_loan_rules.fine_each_day) AS 'fine_total'")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) <", "TO_DAYS('$date')", false)
            ->orderby($orderBy, $direction)
            ->paginate($perPage, 'default', $page);
    }

    public function getAllFinesHmin($perPage, $page, $orderBy, $direction)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, member.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) =", "TO_DAYS('$date') + 1", false)
            ->orderby($orderBy, $direction)
            ->paginate($perPage, 'default', $page);
    }

    public function getFineById($id)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, loan.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date, DATEDIFF(CURDATE(), loan.due_date) AS 'days_total', (DATEDIFF(CURDATE(), loan.due_date) * mst_loan_rules.fine_each_day) AS 'fine_total'")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) <", "TO_DAYS('$date')", false)
            ->where("loan.loan_id", $id)
            ->first();
    }

    public function search($perPage, $page, $orderBy, $direction, $memberId)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, loan.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date, DATEDIFF(CURDATE(), loan.due_date) AS 'days_total', (DATEDIFF(CURDATE(), loan.due_date) * mst_loan_rules.fine_each_day) AS 'fine_total'")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) <", "TO_DAYS('$date')", false)
            ->like("member.member_id", $memberId)
            ->orderby($orderBy, $direction)
            ->paginate($perPage, 'default', $page);
    }

    public function setFineDone($id)
    {
        $date = date('Y-m-d');
        return $this->update($id, ["is_return" => 1, "return_date" => $date]);
    }

    public function getFinesByMemberId($perPage, $page, $memberId)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, loan.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date, DATEDIFF(CURDATE(), loan.due_date) AS 'days_total', (DATEDIFF(CURDATE(), loan.due_date) * mst_loan_rules.fine_each_day) AS 'fine_total'")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) <", "TO_DAYS('$date')", false)
            ->where("member.member_id", $memberId)
            ->orderby("due_date", "DESC")
            ->paginate($perPage, 'default', $page);
    }

    public function getLoansByMemberId($perPage, $page, $memberId)
    {
        $date = date('Y-m-d');
        return $this->select("loan.loan_id, loan.member_id, member.member_name, member.member_phone, member.member_email, loan.item_code, biblio.title, loan.loan_date, loan.due_date")
            ->join("member", "member.member_id = loan.member_id", "left")
            ->join("item", "item.item_code = loan.item_code", "left")
            ->join("biblio", "biblio.biblio_id = item.biblio_id", "left")
            ->join("(SELECT member_type_id, MAX(fine_each_day) AS fine_each_day FROM mst_loan_rules GROUP BY member_type_id) AS mst_loan_rules", "mst_loan_rules.member_type_id = member.member_type_id", "left")
            ->where('loan.is_lent', 1)
            ->where('loan.is_return', 0)
            ->where("TO_DAYS(due_date) >", "TO_DAYS('$date')", false)
            ->where("member.member_id", $memberId)
            ->orderby("due_date", "DESC")
            ->paginate($perPage, 'default', $page);
    }
}
