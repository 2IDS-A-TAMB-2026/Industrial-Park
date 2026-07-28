<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuperAdmModel;
use App\Models\VagasModel;

class SuperAdmController extends BaseController
{
    // LOGIN
    public function login()
    {
        return view('sistema/superadm/login');
    }

    // AUTENTICAR
    public function auth()
    {
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $model = new SuperAdmModel();

        $superadmin = $model
            ->where('SUP_EMAIL', $email)
            ->where('SUP_SENHA', $senha)
            ->first();

        if ($superadmin) {

            session()->set('superadmin', $superadmin);

            return redirect()->to('/dashboard-superadm');
        }

        return redirect()
            ->to('/superadm')
            ->with('erro', 'Usuário não encontrado');
    }

    // DASHBOARD
    public function dashboard()
    {
        if (!session()->get('superadmin')) {
            return redirect()->to('/superadm');
        }

        $superAdmModel = new SuperAdmModel();
        $vagaModel = new VagasModel();

        // Lista de administradores
        $superadmins = $superAdmModel->findAll();

        // Lista de vagas
        $vagas = $vagaModel->findAll();

        // Estatísticas
        $total = count($vagas);

        $livres = $vagaModel
            ->where('VAG_STATUS', 'Livre')
            ->countAllResults();

        $ocupadas = $vagaModel
            ->where('VAG_STATUS', 'Ocupada')
            ->countAllResults();

        $taxa = ($total > 0)
            ? round(($ocupadas / $total) * 100)
            : 0;

        $dados = [
            'superadmins' => $superadmins,
            'vagas' => $vagas,
            'total' => $total,
            'livres' => $livres,
            'ocupadas' => $ocupadas,
            'taxa' => $taxa
        ];

        return view('sistema/superadm/dashboard', $dados);
    }

    // LOGOUT
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/superadm');
    }
}