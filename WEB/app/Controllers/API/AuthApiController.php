<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\API\ResponseTrait;

class AuthApiController extends BaseController
{
    use ResponseTrait;

    public function autenticar()
    {
        // Lê os dados enviados no JSON
        $json = $this->request->getJSON();
        
        $email = $json->USU_EMAIL ?? $this->request->getVar('USU_EMAIL');
        $senha = $json->USU_SENHA ?? $this->request->getVar('USU_SENHA');

        if (!$email || !$senha) {
            return $this->fail('E-mail e senha são obrigatórios.', 400);
        }

        $model = new AuthModel();
        $user  = $model->getUserByEmail($email);

        if (!$user) {
            return $this->failNotFound('Usuário não encontrado');
        }

        if (!password_verify($senha, $user['USU_SENHA'])) {
            return $this->failUnauthorized('Senha incorreta');
        }

        // Grava na sessão como você já fazia
        session()->set([
            'cpf'    => $user['USU_CPF'],
            'nome'   => $user['USU_NOME'],
            'tipo'   => $user['USU_TIPO'],
            'logado' => true
        ]);

        unset($user['USU_SENHA']); // Esconde a hash por segurança

        // Retorna JSON com o caminho de redirecionamento
        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Bem-vindo!',
            'redirect' => $this->getDashboardRoute($user['USU_TIPO']),
            'usuario'  => $user
        ]);
    }

    private function getDashboardRoute($tipo)
    {
        switch ($tipo) {
            case 'SUPERADM': return '/dashboard-superadm';
            case 'ADMIN':    return '/dashboard-admin';
            case 'PORTEIRO': return '/dashboard-porteiro';
            default:         return '/dashboard-usu';
        }
    }
}