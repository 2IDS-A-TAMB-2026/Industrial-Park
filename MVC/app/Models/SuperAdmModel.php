<?php

namespace App\Models;

use CodeIgniter\Model;

class SuperAdmModel extends Model
{
    protected $table = 'SUPERADM';

    protected $primaryKey = 'SUP_CPF';

    protected $allowedFields = [
        'SUP_CPF',
        'SUP_NOME',
        'SUP_EMAIL',
        'SUP_SENHA',
        'SUP_STATUS'
    ];
}