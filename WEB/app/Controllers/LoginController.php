<?php

namespace App\Controllers;

use App\Models\AuthModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function autenticar()
    {
        $email = $this->request->getPost('USR_EMAIL');
        $senha = $this->request->getPost('USR_SENHA');

        $authModel = new AuthModel();

        $usuario = $authModel->autenticar($email, $senha);

        if (!$usuario) {

            return redirect()
                ->back()
                ->with('erro', 'E-mail ou senha inválidos');
        }

        session()->set([
    'USR_CPF'      => $usuario['USU_CPF'],
    'USR_NOME'     => $usuario['USU_NOME'],
    'USR_EMAIL'    => $usuario['USU_EMAIL'],
    'USR_TIPO'     => $usuario['USU_TIPO'],
    'FK_EMP_CNPJ'  => $usuario['FK_EMP_CNPJ'],
    'logado'       => true
]);

        switch ($usuario['TIPO']) {

            case 'SUPERADMIN':
                return redirect()->to('/superadmin/dashboard');

            case 'ADMIN':
                return redirect()->to('/admin/dashboard');

            case 'PORTEIRO':
                return redirect()->to('/porteiro/dashboard');

            case 'USUARIO':
                return redirect()->to('/usuario/dashboard');

            default:
                session()->destroy();
                return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}