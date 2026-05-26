<?php

namespace App\Models;

use CodeIgniter\Model;

class VagasModel extends Model
{
    protected $table = 'VAGAS';

    protected $primaryKey = 'VAG_ID';

    protected $allowedFields = [
        'VAG_NOME',
        'VAG_DESCRICAO',
        'VAG_STATUS'
    ];
}