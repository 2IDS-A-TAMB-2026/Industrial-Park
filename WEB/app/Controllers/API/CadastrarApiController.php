<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class CadastrarApiController extends BaseController
{
    use ResponseTrait;

    public function inserirPorteiro()
    {
        return $this->salvarUsuario('PORTEIRO');
    }

    public function inserirAdmin()
    {
        return $this->salvarUsuario('ADMIN');
    }

    public function inserirUsuario()
    {
        return $this->salvarUsuario('USUARIO');
    }

    private function salvarUsuario($tipo)
    {
        // Aceita dados vindos tanto em JSON quanto Form Data
        $json = $this->request->getJSON(true) ?? [];

        $cpfPost = $json['USR_CPF'] ?? $json['USU_CPF'] ?? $this->request->getVar('USR_CPF') ?? $this->request->getVar('USU_CPF');
        $nome    = $json['USR_NOME'] ?? $json['USU_NOME'] ?? $this->request->getVar('USR_NOME') ?? $this->request->getVar('USU_NOME');
        $email   = $json['USR_EMAIL'] ?? $json['USU_EMAIL'] ?? $this->request->getVar('USR_EMAIL') ?? $this->request->getVar('USU_EMAIL');
        $senha   = $json['USR_SENHA'] ?? $json['USU_SENHA'] ?? $this->request->getVar('USR_SENHA') ?? $this->request->getVar('USU_SENHA');
        $data    = $json['USR_DATA_NASC'] ?? $json['USU_DATA_NASCIMENTO'] ?? $this->request->getVar('USR_DATA_NASC') ?? $this->request->getVar('USU_DATA_NASCIMENTO');
        $empresa = $json['FK_EMP_CNPJ'] ?? $this->request->getVar('FK_EMP_CNPJ');

        $cpfLimpo = preg_replace('/\D/', '', (string)$cpfPost);

        if (empty($cpfLimpo)) {
            return $this->fail('CPF inválido ou não informado.', 400);
        }

        if (empty($nome) || empty($email) || empty($senha)) {
            return $this->fail('Preencha todos os campos obrigatórios (Nome, E-mail e Senha).', 400);
        }

        $model = new UsuarioModel();

        // Verifica se o CPF já existe
        if ($model->where('USU_CPF', $cpfLimpo)->first()) {
            return $this->failResourceExists('Este CPF já está cadastrado no sistema.');
        }

        $dados = [
            'USU_CPF'             => $cpfLimpo,
            'USU_NOME'            => $nome,
            'USU_EMAIL'           => $email,
            'USU_SENHA'           => password_hash($senha, PASSWORD_DEFAULT),
            'USU_DATA_NASCIMENTO' => $data,
            'USU_TIPO'            => $tipo,
            'FK_EMP_CNPJ'         => !empty($empresa) ? $empresa : null
        ];

        $model->insert($dados);

        return $this->respondCreated([
            'status'   => 201,
            'mensagem' => 'Cadastro realizado com sucesso!',
            'tipo'     => $tipo
        ]);
    }
}