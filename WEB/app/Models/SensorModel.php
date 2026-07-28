<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorModel extends Model
{
    protected $table = 'SENSOR';

    protected $primaryKey = 'SEN_ID';

    protected $allowedFields = [
        'SEN_STATUS',
        'FK_VAG_ID',
        'FK_EMP_CNPJ'
    ];

    protected $returnType = 'array';
}