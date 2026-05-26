<?php

namespace App\Controllers;

use App\Models\VagasModel;

class VagaController extends BaseController
{
    public function index()
    {
        $model = new VagasModel();

        $dados['vagas'] = $model->findAll();

        return view('sistema/vagas/index', $dados);
    }

    public function novo()
    {
        return view('sistema/vagas/nova_vaga');
    }

    public function inserir()
    {
        $model = new VagasModel();

        $dados = [
            'VAG_NOME' => $this->request->getPost('nome'),
            'VAG_DESCRICAO' => $this->request->getPost('descricao'),
            'VAG_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/vagas');
    }

    public function excluir($id)
    {
        $model = new VagasModel();

        $model->delete($id);

        return redirect()->to('/vagas');
    }
}

namespace App\Controllers;

use App\Models\VagasModel;

class VagasController extends BaseController
{
  
    public function index()
    {
        $model = new VagasModel();

        $dados['vagas'] = $model->findAll();

        return view('sistema/vagas/index', $dados);
    }

    public function novo()
    {
        return view('sistema/vagas/nova_vaga');
    }

    public function inserir()
    {
        $model = new VagasModel();

        $dados = [
            'NUMERO' => $this->request->getPost('numero'),
            'SETOR' => $this->request->getPost('setor'),
            'STATUS' => $this->request->getPost('status'),
            'TIPO' => $this->request->getPost('tipo')
        ];

        $model->insert($dados);

        return redirect()->to('/vagas');
    }

    public function editar($id)
    {
        $model = new VagasModel();

        $dados['vaga'] = $model->find($id);

        return view('sistema/vagas/editar_vaga', $dados);
    }

    public function atualizar($id)
    {
        $model = new VagasModel();

        $dados = [
            'NUMERO' => $this->request->getPost('numero'),
            'SETOR' => $this->request->getPost('setor'),
            'STATUS' => $this->request->getPost('status'),
            'TIPO' => $this->request->getPost('tipo')
        ];

        $model->update($id, $dados);

        return redirect()->to('/vagas');
    }

    public function excluir($id)
    {
        $model = new VagasModel();

        $model->delete($id);

        return redirect()->to('/vagas');
    }

    public function visualizar($id)
    {
        $model = new VagasModel();

        $dados['vaga'] = $model->find($id);

        return view('sistema/vagas/visualizar_vaga', $dados);
    }
}