<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuperAdmModel;

class SuperAdmController extends BaseController
{
    public function index()
    {
        $model = new SuperAdmModel();
        $data['superadmins'] = $model->where('USU_TIPO', 'SUPERADM')->findAll();
        return view('superadm', $data);
    }

    public function login()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new SuperAdmModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $superadmin = $model->where('USU_EMAIL', $email)
                            ->where('USU_SENHA', $senha)
                            ->where('USU_TIPO', 'SUPERADM')
                            ->first();

        if ($superadmin) {
            $session->set([
                'cpf'        => $superadmin['USU_CPF'],
                'nome'       => $superadmin['USU_NOME'],
                'email'      => $superadmin['USU_EMAIL'],
                'tipo'       => $superadmin['USU_TIPO'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/superadm');
        } else {
            $session->setFlashdata('msg', 'E-mail ou Senha incorretos!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}