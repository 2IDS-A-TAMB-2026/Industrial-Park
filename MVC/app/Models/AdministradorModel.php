<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministradorModel extends Model
{
    protected $table = 'ADMINISTRADOR';

    protected $primaryKey = 'ADM_CPF';

    protected $allowedFields = [
        'ADM_CPF',
        'ADM_NOME',
        'ADM_EMAIL',
        'ADM_SENHA',
        'FK_EMP_CNPJ'
    ];
}