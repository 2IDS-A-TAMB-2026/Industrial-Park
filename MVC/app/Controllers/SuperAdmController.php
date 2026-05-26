<?php

namespace App\Controllers;

use App\Models\SuperAdmModel;

class SuperAdmController extends BaseController
{
    public function index()
    {
        $model = new SuperAdmModel();

        $dados['superadmins'] = $model->findAll();

        return view('sistema/superadm/index', $dados);
    }

    public function excluir($id)
    {
        $model = new SuperAdmModel();

        $model->delete($id);

        return redirect()->to('/superadm');
    }
}