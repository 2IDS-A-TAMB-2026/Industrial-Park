<?php

namespace App\Models;

use CodeIgniter\Model;

class PorteiroModel extends Model
{
    protected $table = 'PORTEIRO';

    protected $primaryKey = 'POR_CPF';

    protected $allowedFields = [
        'POR_CPF',
        'POR_NOME',
        'POR_EMAIL',
        'POR_SENHA',
        'POR_STATUS'
    ];
}