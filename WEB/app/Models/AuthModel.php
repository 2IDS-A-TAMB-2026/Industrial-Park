<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'USUARIO';
    protected $primaryKey = 'USU_CPF';

    protected $allowedFields = [
        'USU_CPF',
        'USU_NOME',
        'USU_EMAIL',
        'USU_SENHA',
        'USU_TIPO',
        'FK_EMP_CNPJ'
    ];

    public function getUserByEmail($email)
    {
        return $this->where('USU_EMAIL', $email)->first();
    }
}