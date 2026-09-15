<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class HomeApiController extends ResourceController
{
    protected $format = 'json';

    // GET /api/status
    public function status()
    {
        return $this->respond([
            'status'     => 'online',
            'versao'     => '1.0.0',
            'timestamp'  => date('Y-m-d H:i:s'),
            'sessao'     => [
                'autenticado' => session()->has('id'),
                'usuario'     => session()->get('nome') ?? 'Visitante'
            ]
        ]);
    }
}