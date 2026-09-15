<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpresasModel;

class EmpresasController extends BaseController
{
    // Tela Principal (Tabela)
    public function index()
    {
        $model = new EmpresasModel();
        $dados['empresas'] = $model->findAll();

        return view('sistema/empresas/index', $dados);
    }

    // Tela de Nova Empresa
    public function nova()
    {
        return view('sistema/empresas/nova_empresa');
    }

public function inserir()
{
    $model = new EmpresasModel();

    $dados = $this->request->getPost();

    $cnpj = preg_replace('/\D/', '', $dados['EMP_CNPJ'] ?? '');

    if (empty($cnpj)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Informe o CNPJ da empresa.');
    }

    if (strlen($cnpj) !== 14) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'O CNPJ deve possuir 14 números.');
    }

    if ($model->find($cnpj)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Este CNPJ já está cadastrado.');
    }

    $empresa = [
        'EMP_CNPJ'   => $cnpj,
        'EMP_NOME'   => trim($dados['EMP_NOME'] ?? ''),
        'EMP_RUA'    => trim($dados['EMP_RUA'] ?? ''),
        'EMP_NUMERO' => trim($dados['EMP_NUMERO'] ?? ''),
        'EMP_CIDADE' => trim($dados['EMP_CIDADE'] ?? ''),
        'EMP_STATUS' => $dados['EMP_STATUS'] ?? 'Ativa'
    ];

    // Validação dos campos
    if (
        empty($empresa['EMP_NOME']) ||
        empty($empresa['EMP_RUA']) ||
        empty($empresa['EMP_NUMERO']) ||
        empty($empresa['EMP_CIDADE']) ||
        empty($empresa['EMP_STATUS'])
    ) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Preencha todos os campos da empresa.');
    }

    if (strlen($empresa['EMP_NUMERO']) > 5) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'O número da empresa deve possuir no máximo 5 caracteres.');
    }

    try {

        /*
         * NÃO usamos:
         *
         * if ($model->insert($empresa))
         *
         * porque EMP_CNPJ não é AUTO_INCREMENT.
         *
         * Fazemos o insert e depois verificamos se o registro
         * realmente existe no banco.
         */

        $model->insert($empresa);

        // Confirma que o registro realmente foi gravado
        $empresaCadastrada = $model->find($cnpj);

        if ($empresaCadastrada) {

            return redirect()
                ->to('/empresas')
                ->with('sucesso', 'Empresa cadastrada com sucesso!');

        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Não foi possível confirmar o cadastro da empresa.');

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Erro ao cadastrar a empresa: ' . $e->getMessage()
            );
    }
}
    // Tela de Editar Empresa
    public function editar($cnpj)
    {
        $model = new EmpresasModel();

        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        $dados['empresa'] = $model->find($cnpjLimpo);

        if (!$dados['empresa']) {
            return redirect()->to('/empresas')
                ->with('error', 'Empresa não encontrada.');
        }

        return view('sistema/empresas/editar_empresa', $dados);
    }

    // Atualizar Empresa
    public function atualizar($cnpj)
    {
        $model = new EmpresasModel();

        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        if (!$model->find($cnpjLimpo)) {
            return redirect()->to('/empresas')
                ->with('error', 'Empresa não encontrada.');
        }

        $dados = $this->request->getPost();

        $empresa = [
            'EMP_NOME'   => trim($dados['EMP_NOME'] ?? ''),
            'EMP_RUA'    => trim($dados['EMP_RUA'] ?? ''),
            'EMP_NUMERO' => trim($dados['EMP_NUMERO'] ?? ''),
            'EMP_CIDADE' => trim($dados['EMP_CIDADE'] ?? ''),
            'EMP_STATUS' => $dados['EMP_STATUS'] ?? 'Ativa'
        ];

        if ($model->update($cnpjLimpo, $empresa)) {
            return redirect()->to('/empresas')
                ->with('sucesso', 'Empresa atualizada com sucesso!');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Erro ao atualizar a empresa.');
    }

    // Excluir Empresa
    public function excluir($cnpj)
    {
        $model = new EmpresasModel();

        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        if (!$model->find($cnpjLimpo)) {
            return redirect()->to('/empresas')
                ->with('error', 'Empresa não encontrada.');
        }

        if ($model->delete($cnpjLimpo)) {
            return redirect()->to('/empresas')
                ->with('sucesso', 'Empresa excluída com sucesso!');
        }

        return redirect()->to('/empresas')
            ->with('error', 'Erro ao excluir a empresa.');
    }

    // Tela de Visualizar Empresa
    public function visualizar($cnpj)
    {
        $model = new EmpresasModel();

        $cnpjLimpo = preg_replace('/\D/', '', $cnpj);

        $dados['empresa'] = $model->find($cnpjLimpo);

        if (!$dados['empresa']) {
            return redirect()->to('/empresas')
                ->with('error', 'Empresa não encontrada.');
        }

        return view('sistema/empresas/visualizar_empresa', $dados);
    }
}

