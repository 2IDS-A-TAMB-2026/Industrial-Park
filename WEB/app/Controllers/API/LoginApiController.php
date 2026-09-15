<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AuthModel;

class LoginApiController extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        // Suporta envio em JSON ou dados de Formulário
        $json = $this->request->getJSON(true);
        $email = $json['USR_EMAIL'] ?? $this->request->getPost('USR_EMAIL');
        $senha = $json['USR_SENHA'] ?? $this->request->getPost('USR_SENHA');

        if (empty($email) || empty($senha)) {
            return $this->fail('Preencha os campos de e-mail e senha.', 400);
        }

        $authModel = new AuthModel();
        $usuario = $authModel->autenticar($email, $senha);

        if (!$usuario) {
            return $this->failUnauthorized('E-mail ou senha inválidos.');
        }

        // Pega o tipo tratando possíveis divergências de nome de coluna
        $tipo = $usuario['USU_TIPO'] ?? $usuario['TIPO'] ?? 'USUARIO';

        // Registra a sessão no servidor
        session()->set([
            'USR_CPF'     => $usuario['USU_CPF'] ?? null,
            'USR_NOME'    => $usuario['USU_NOME'] ?? null,
            'USR_EMAIL'   => $usuario['USU_EMAIL'] ?? null,
            'USR_TIPO'    => $tipo,
            'FK_EMP_CNPJ' => $usuario['FK_EMP_CNPJ'] ?? null,
            'logado'      => true
        ]);

        // Mapeamento das rotas de destino pós-login
        $rotas = [
            'SUPERADMIN' => base_url('/superadmin/dashboard'),
            'ADMIN'      => base_url('/admin/dashboard'),
            'PORTEIRO'   => base_url('/porteiro/dashboard'),
            'USUARIO'    => base_url('/usuario/dashboard')
        ];

        $redirecionar = $rotas[$tipo] ?? base_url('/login');

        return $this->respond([
            'status'       => true,
            'mensagem'     => 'Autenticado com sucesso!',
            'redirecionar' => $redirecionar,
            'usuario'      => [
                'nome'  => $usuario['USU_NOME'] ?? '',
                'email' => $usuario['USU_EMAIL'] ?? '',
                'tipo'  => $tipo
            ]
        ], 200);
    }

    public function logout()
    {
        session()->destroy();

        return $this->respond([
            'status'       => true,
            'mensagem'     => 'Sessão encerrada com sucesso.',
            'redirecionar' => base_url('/login')
        ], 200);
    }
}