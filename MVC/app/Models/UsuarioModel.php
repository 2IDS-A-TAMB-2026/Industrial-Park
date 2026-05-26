<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'USUARIO';

    protected $primaryKey = 'USU_CPF';

    protected $allowedFields = [
        'USU_CPF',
        'USU_NOME',
        'USU_EMAIL',
        'USU_SENHA',
        'USU_STATUS'
    ];
}