<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'content';
    protected $primaryKey       = 'content_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
    protected $DBGroup = 'opac';


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

    public function search($perPage, $page, $orderBy, $direction, $keyword)
    {
        return $this->select("
           content.content_id,
           content.content_title,
           content.content_desc,
           content.content_path,
           content.is_news,
           content.is_draft,
           content.publish_date,
           content.input_date,
           content.last_update,
           content.content_ownpage
        ")
            ->groupStart()
            ->like("content.content_id", $keyword)
            ->orLike("content.content_title", $keyword)
            ->orLike("content.content_desc", $keyword)
            ->orLike("content.content_path", $keyword)
            ->orLike("content.content_path", $keyword)
            ->groupEnd()
            ->orderby($orderBy, $direction)
            ->paginate($perPage, 'default', $page);
    }


    public function getcontent($perPage, $page, $orderBy, $direction)
    {
        return $this->select("
           content.content_id,
           content.content_title,
           content.content_desc,
           content.content_path,
           content.is_news,
           content.is_draft,
           content.publish_date,
           content.input_date,
           content.last_update,
           content.content_ownpage
        ")
            ->orderby($orderBy, $direction)
            ->paginate($perPage, "default", $page);
    }
}
