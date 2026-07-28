<?php

namespace App\Models;

use CodeIgniter\Model;

class VagasModel extends Model
{
    protected $table = 'VAGAS';
    protected $primaryKey = 'VAG_ID';

    protected $returnType = 'array';

    protected $allowedFields = [
        'VAG_SETOR',
        'VAG_STATUS',
        'VAG_LOCALIZACAO',
        'FK_EMP_CNPJ'
    ];
}