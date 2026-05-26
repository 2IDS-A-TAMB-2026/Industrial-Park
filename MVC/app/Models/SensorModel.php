<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorModel extends Model
{
    protected $table = 'SENSOR';

    protected $primaryKey = 'SEN_ID';

    protected $allowedFields = [
        'SEN_NOME',
        'SEN_TIPO',
        'SEN_STATUS'
    ];
}