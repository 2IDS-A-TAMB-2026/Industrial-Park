<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EmpresasModel;

class EmpresasApiController extends ResourceController
{
    protected $format = 'json';

    // =========================================================
    // CADASTRAR EMPRESA
    // =========================================================
    public function criar()
    {
        $model = new EmpresasModel();

        try {

            $dados = $this->request->getJSON(true);

            if (!is_array($dados)) {
                $dados = $this->request->getPost();
            }

            // CNPJ
            $cnpj = preg_replace('/\D/', '', $dados['EMP_CNPJ'] ?? '');

            if (empty($cnpj)) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Informe o CNPJ da empresa.'
                ], 400);
            }

            if (strlen($cnpj) !== 14) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'O CNPJ deve possuir 14 números.'
                ], 400);
            }

            // Verifica duplicidade
            $empresaExistente = $model->find($cnpj);

            if ($empresaExistente) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Este CNPJ já está cadastrado.'
                ], 400);
            }

            // Dados compatíveis com a tabela EMPRESA
            $empresa = [
                'EMP_CNPJ'   => $cnpj,
                'EMP_NOME'   => trim($dados['EMP_NOME'] ?? ''),
                'EMP_RUA'    => trim($dados['EMP_RUA'] ?? ''),
                'EMP_NUMERO' => trim($dados['EMP_NUMERO'] ?? ''),
                'EMP_CIDADE' => trim($dados['EMP_CIDADE'] ?? ''),
                'EMP_STATUS' => trim($dados['EMP_STATUS'] ?? '')
            ];

            // Campos obrigatórios do banco
            if (
                empty($empresa['EMP_NOME']) ||
                empty($empresa['EMP_RUA']) ||
                empty($empresa['EMP_NUMERO']) ||
                empty($empresa['EMP_CIDADE']) ||
                empty($empresa['EMP_STATUS'])
            ) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Preencha todos os campos obrigatórios.'
                ], 400);
            }

            // Número possui VARCHAR(5) no banco
            if (strlen($empresa['EMP_NUMERO']) > 5) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'O número do endereço deve possuir no máximo 5 caracteres.'
                ], 400);
            }

            if ($model->insert($empresa)) {

                return $this->respondCreated([
                    'sucesso' => true,
                    'mensagem' => 'Empresa cadastrada com sucesso!'
                ]);
            }

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Não foi possível cadastrar a empresa.',
                'erros' => $model->errors()
            ], 500);

        } catch (\Throwable $e) {

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar empresa.',
                'erro' => $e->getMessage()
            ], 500);
        }
    }


    // =========================================================
    // ATUALIZAR EMPRESA
    // =========================================================
    public function atualizar($cnpj = null)
    {
        $model = new EmpresasModel();

        try {

            $cnpjLimpo = preg_replace('/\D/', '', $cnpj ?? '');

            if (empty($cnpjLimpo)) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'CNPJ inválido.'
                ], 400);
            }

            $empresaExistente = $model->find($cnpjLimpo);

            if (!$empresaExistente) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Empresa não encontrada.'
                ], 404);
            }

            $dados = $this->request->getJSON(true);

            if (!is_array($dados)) {
                $dados = $this->request->getPost();
            }

            $empresa = [
                'EMP_NOME'   => trim($dados['EMP_NOME'] ?? ''),
                'EMP_RUA'    => trim($dados['EMP_RUA'] ?? ''),
                'EMP_NUMERO' => trim($dados['EMP_NUMERO'] ?? ''),
                'EMP_CIDADE' => trim($dados['EMP_CIDADE'] ?? ''),
                'EMP_STATUS' => trim($dados['EMP_STATUS'] ?? '')
            ];

            if (
                empty($empresa['EMP_NOME']) ||
                empty($empresa['EMP_RUA']) ||
                empty($empresa['EMP_NUMERO']) ||
                empty($empresa['EMP_CIDADE']) ||
                empty($empresa['EMP_STATUS'])
            ) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Preencha todos os campos obrigatórios.'
                ], 400);
            }

            if (strlen($empresa['EMP_NUMERO']) > 5) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'O número do endereço deve possuir no máximo 5 caracteres.'
                ], 400);
            }

            if ($model->update($cnpjLimpo, $empresa)) {

                return $this->respond([
                    'sucesso' => true,
                    'mensagem' => 'Empresa atualizada com sucesso!'
                ], 200);
            }

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Não foi possível atualizar a empresa.',
                'erros' => $model->errors()
            ], 500);

        } catch (\Throwable $e) {

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Erro ao atualizar empresa.',
                'erro' => $e->getMessage()
            ], 500);
        }
    }


    // =========================================================
    // EXCLUIR EMPRESA
    // =========================================================
    public function excluir($cnpj = null)
    {
        $model = new EmpresasModel();

        try {

            $cnpjLimpo = preg_replace('/\D/', '', $cnpj ?? '');

            if (empty($cnpjLimpo)) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'CNPJ inválido.'
                ], 400);
            }

            $empresaExistente = $model->find($cnpjLimpo);

            if (!$empresaExistente) {
                return $this->respond([
                    'sucesso' => false,
                    'mensagem' => 'Empresa não encontrada.'
                ], 404);
            }

            /*
             * O banco possui ON DELETE CASCADE nas tabelas:
             * USUARIO
             * VAGAS
             * SENSOR
             * DADOS
             *
             * Portanto, ao excluir uma empresa,
             * os registros relacionados serão tratados pelo banco.
             */

            if ($model->delete($cnpjLimpo)) {

                return $this->respond([
                    'sucesso' => true,
                    'mensagem' => 'Empresa excluída com sucesso!'
                ], 200);
            }

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Não foi possível excluir a empresa.',
                'erros' => $model->errors()
            ], 500);

        } catch (\Throwable $e) {

            return $this->respond([
                'sucesso' => false,
                'mensagem' => 'Erro ao excluir empresa.',
                'erro' => $e->getMessage()
            ], 500);
        }
    }
}
