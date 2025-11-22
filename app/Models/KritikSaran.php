<?php

namespace App\Models;

use CodeIgniter\Model;

class KritikSaran extends Model
{
    protected $table            = 'kritik_saran';
    protected $primaryKey       = 'kritik_saran_id';
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

    public function getKritikSaran($perPage, $page)
    {
        return $this->select("
           kritik_saran_id,
           email,
           message,
           input_date,
           last_update
        ")
            ->orderby("kritik_saran_id", "DESC")
            ->paginate($perPage, "default", $page);
    }
}
