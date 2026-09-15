<?php

namespace App\Models;

use CodeIgniter\Model;

class SuperAdmModel extends Model
{
    protected $table            = 'USUARIO';
    protected $primaryKey       = 'USU_CPF';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['USU_CPF', 'USU_NOME', 'USU_EMAIL', 'USU_SENHA', 'USU_TIPO', 'USU_STATUS'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = false;
}