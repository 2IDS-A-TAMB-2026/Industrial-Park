<?php

namespace App\Models;

use CodeIgniter\Model;

class DadosModel extends Model
{
    protected $table = 'DADOS';

    protected $primaryKey = 'DAD_ID';

    protected $allowedFields = [
        'DAD_DESCRICAO',
        'DAD_VALOR',
        'DAD_STATUS'
    ];
}