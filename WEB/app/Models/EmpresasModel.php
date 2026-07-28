<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresasModel extends Model
{
    protected $table = 'EMPRESA';

    protected $primaryKey = 'EMP_CNPJ';

    protected $allowedFields = [

        'EMP_CNPJ',
        'EMP_NOME',
        'EMP_RUA',
        'EMP_NUMERO',
        'EMP_CIDADE',
        'EMP_STATUS'

    ];

    protected $returnType = 'array';
}