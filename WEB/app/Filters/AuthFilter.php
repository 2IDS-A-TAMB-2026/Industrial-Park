<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // NÃO LOGADO → vai pro login
        if (!session()->get('logado')) {
            return redirect()->to('/login');
        }

        $tipo = session()->get('tipo');
        $url1 = service('uri')->getSegment(1);

        // ROTAS LIBERADAS PRA TODOS
        $rotasLiberadas = ['perfil'];

        // =========================
        // USUARIO
        // =========================
        if ($tipo == 'USUARIO')
        {
            if (!in_array($url1, array_merge([
                'dashboard-usu'
            ], $rotasLiberadas)))
            {
                return redirect()->to('/acesso-negado');
            }
        }

        // =========================
        // PORTEIRO
        // =========================
        if ($tipo == 'PORTEIRO')
        {
            if (!in_array($url1, array_merge([
                'dashboard-porteiro'
            ], $rotasLiberadas)))
            {
                return redirect()->to('/acesso-negado');
            }
        }

        // =========================
        // ADMIN
        // =========================
        if ($tipo == 'ADMIN')
        {
            if (!in_array($url1, array_merge([
                'dashboard-admin',
                'vagas',
                'sensores',
                'porteiros',
                'usuarios'
                

            ], $rotasLiberadas)))
            {
                return redirect()->to('/acesso-negado');
            }
        }

        // =========================
        // SUPERADM (liberado tudo)
        // =========================
        if ($tipo == 'SUPERADM')
        {
            return;
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // nada aqui
    }
}