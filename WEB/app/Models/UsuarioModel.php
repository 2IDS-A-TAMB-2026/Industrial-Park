<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'USUARIO';
    protected $primaryKey       = 'USU_CPF'; // 🔒 Define o CPF como chave primária
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'USU_CPF', 
        'USU_NOME', 
        'USU_EMAIL', 
        'USU_SENHA', 
        'USU_DATA_NASCIMENTO', 
        'USU_TIPO', 
        'FK_EMP_CNPJ', 
        'USU_FOTO'
    ];
}