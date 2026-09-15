<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SuperAdmModel;
use App\Models\VagasModel;

class SuperAdmApiController extends ResourceController
{
    protected $format = 'json';

    // POST /api/superadm/login - Autenticação
    public function login()
    {
        $json  = $this->request->getJSON(true);
        $email = $json['email'] ?? $this->request->getPost('email');
        $senha = $json['senha'] ?? $this->request->getPost('senha');

        if (empty($email) || empty($senha)) {
            return $this->fail('E-mail e senha são obrigatórios.', 400);
        }

        $model = new SuperAdmModel();
        $superadmin = $model
            ->where('SUP_EMAIL', $email)
            ->where('SUP_SENHA', $senha)
            ->first();

        if (!$superadmin) {
            return $this->failUnauthorized('Credenciais inválidas ou usuário não encontrado.');
        }

        // Removendo a senha da resposta por segurança
        unset($superadmin['SUP_SENHA']);

        session()->set('superadmin', $superadmin);

        return $this->respond([
            'status'   => true,
            'mensagem' => 'Login realizado com sucesso!',
            'usuario'  => $superadmin
        ]);
    }

    // GET /api/superadm/dashboard - Dados do Dashboard
    public function dashboard()
    {
        if (!session()->get('superadmin')) {
            return $this->failUnauthorized('Sessão expirada ou acesso negado.');
        }

        $superAdmModel = new SuperAdmModel();
        $vagaModel     = new VagasModel();

        $superadmins = $superAdmModel->findAll();
        $vagas       = $vagaModel->findAll();

        $total    = count($vagas);
        $livres   = $vagaModel->where('VAG_STATUS', 'Livre')->countAllResults();
        $ocupadas = $vagaModel->where('VAG_STATUS', 'Ocupada')->countAllResults();
        $taxa     = ($total > 0) ? round(($ocupadas / $total) * 100) : 0;

        // Limpa as senhas da lista enviada pela API
        foreach ($superadmins as &$adm) {
            unset($adm['SUP_SENHA']);
        }

        return $this->respond([
            'status'      => true,
            'estatisticas' => [
                'total'    => $total,
                'livres'   => $livres,
                'ocupadas' => $ocupadas,
                'taxa'     => $taxa
            ],
            'superadmins' => $superadmins,
            'vagas'       => $vagas
        ]);
    }

    // POST /api/superadm/logout - Encerrar Sessão
    public function logout()
    {
        session()->destroy();

        return $this->respond([
            'status'   => true,
            'mensagem' => 'Sessão encerrada com sucesso!'
        ]);
    }
}