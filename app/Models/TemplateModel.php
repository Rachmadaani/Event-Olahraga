<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table            = 'template_sertifikat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama_template', 'gambar'];
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
