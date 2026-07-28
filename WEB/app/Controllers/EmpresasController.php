<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresasModel;

class EmpresasController extends BaseController
{
    // LISTAGEM
    public function index()
    {
        $model = new EmpresasModel();

        $dados['empresas'] = $model->findAll();

        return view('sistema/empresas/index', $dados);
    }

    // FORMULÁRIO NOVA EMPRESA
    public function nova()
    {
        return view('sistema/empresas/nova_empresa');
    }

    // INSERIR
    public function inserir()
    {
        $model = new EmpresasModel();

        // Remove os caracteres especiais do CNPJ antes de salvar no banco
        $cnpjLimpo = preg_replace('/\D/', '', $this->request->getPost('EMP_CNPJ'));

        $dados = [
            'EMP_CNPJ'    => $cnpjLimpo,
            'EMP_NOME'    => $this->request->getPost('EMP_NOME'),
            'EMP_RUA'     => $this->request->getPost('EMP_RUA'),
            'EMP_NUMERO'  => $this->request->getPost('EMP_NUMERO'),
            'EMP_CIDADE'  => $this->request->getPost('EMP_CIDADE'),
            'EMP_STATUS'  => $this->request->getPost('EMP_STATUS')
        ];

        $model->insert($dados);

        return redirect()->to('/empresas');
    }

    // EDITAR
    public function editar($cnpj)
    {
        $model = new EmpresasModel();
        
        // Remove pontuação caso venha da URL com a máscara do JavaScript
        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        // Busca no banco (tenta com o CNPJ limpo, se não achar, tenta com a string original)
        $empresa = $model->find($cnpjLimpo) ?? $model->find($cnpj);

        if (!$empresa) {
            return redirect()->to('/empresas')->with('error', 'Empresa não encontrada.');
        }

        $dados['empresa'] = $empresa;

        return view('sistema/empresas/editar_empresa', $dados);
    }

    // ATUALIZAR
    public function atualizar($cnpj)
    {
        $model = new EmpresasModel();
        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        $dados = [
            'EMP_NOME'   => $this->request->getPost('EMP_NOME'),
            'EMP_RUA'    => $this->request->getPost('EMP_RUA'),
            'EMP_NUMERO' => $this->request->getPost('EMP_NUMERO'),
            'EMP_CIDADE' => $this->request->getPost('EMP_CIDADE'),
            'EMP_STATUS' => $this->request->getPost('EMP_STATUS')
        ];

        // Verifica qual formato de chave está registrado no banco para aplicar o update correto
        if ($model->find($cnpjLimpo)) {
            $model->update($cnpjLimpo, $dados);
        } else {
            $model->update($cnpj, $dados);
        }

        return redirect()->to('/empresas');
    }

    // EXCLUIR
    public function excluir($cnpj)
    {
        $model = new EmpresasModel();
        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        // Deleta usando o formato correto encontrado no banco
        if ($model->find($cnpjLimpo)) {
            $model->delete($cnpjLimpo);
        } else {
            $model->delete($cnpj);
        }

        return redirect()->to('/empresas');
    }

    // VISUALIZAR
    public function visualizar($cnpj)
    {
        $model = new EmpresasModel();
        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        $dados['empresa'] = $model->find($cnpjLimpo) ?? $model->find($cnpj);

        if (!$dados['empresa']) {
            return redirect()->to('/empresas')->with('error', 'Empresa não encontrada.');
        }

        return view('sistema/empresas/visualizar_empresa', $dados);
    }
}