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
        /*
         * Tenta receber JSON.
         */
        $json = $this->request->getJSON(true);

        /*
         * Se não veio JSON, tenta POST normal.
         */
        $email = '';

        $senha = '';

        if (is_array($json)) {
            $email = $json['USU_EMAIL'] ?? '';
            $senha = $json['USU_SENHA'] ?? '';
        }

        if ($email === '') {
            $email = $this->request->getPost('USU_EMAIL');
        }

        if ($senha === '') {
            $senha = $this->request->getPost('USU_SENHA');
        }

        /*
         * Limpa o e-mail.
         */
        $email = trim((string) $email);

        $senha = (string) $senha;

        /*
         * Validação.
         */
        if ($email === '' || $senha === '') {
            return $this->respond([
                'status'  => 400,
                'mensagem' => 'E-mail e senha são obrigatórios.'
            ], 400);
        }

        /*
         * Validação do formato do e-mail.
         */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status'   => 400,
                'mensagem' => 'Informe um e-mail válido.'
            ], 400);
        }

        /*
         * Busca usuário.
         */
        $model = new AuthModel();

        $user = $model->getUserByEmail($email);

        if (!$user) {
            return $this->respond([
                'status'   => 404,
                'mensagem' => 'Usuário não encontrado.'
            ], 404);
        }

        /*
         * Verifica senha.
         *
         * Também corrige automaticamente
         * as senhas antigas em texto puro.
         */
        if (!$model->verificarSenha($user, $senha)) {
            return $this->respond([
                'status'   => 401,
                'mensagem' => 'Senha incorreta.'
            ], 401);
        }

        /*
         * Regenera a sessão.
         */
        $session = session();

        $session->regenerate();

        /*
         * Salva dados do usuário.
         */
        $session->set([
            'cpf'    => $user['USU_CPF'],
            'nome'   => $user['USU_NOME'],
            'tipo'   => $user['USU_TIPO'],
            'email'  => $user['USU_EMAIL'],
            'logado' => true
        ]);

        /*
         * Guarda o tipo antes de remover a senha.
         */
        $tipo = $user['USU_TIPO'];

        /*
         * Nunca enviar senha para o navegador.
         */
        unset($user['USU_SENHA']);

        /*
         * Resposta.
         */
        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Login realizado com sucesso!',
            'redirect' => $this->getDashboardRoute($tipo),
            'usuario'  => $user
        ], 200);
    }

    private function getDashboardRoute(string $tipo): string
    {
        switch (strtoupper(trim($tipo))) {

            case 'SUPERADM':
                return '/dashboard-superadm';

            case 'ADMIN':
                return '/dashboard-admin';

            case 'PORTEIRO':
                return '/dashboard-porteiro';

            case 'USUARIO':
                return '/dashboard-usu';

            default:
                return '/dashboard-usu';
        }
    }
}