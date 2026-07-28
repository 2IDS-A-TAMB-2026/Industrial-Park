<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\EmpresasModel;

class CadastrarController extends BaseController
{
    // Rota que carrega a tela de cadastro público (HTML que você me mandou)
    public function index()
    {
        return view('/sistema/cadastro-usuario'); // Ajuste para o nome exato do seu arquivo de view de cadastro
    }

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
        $model = new UsuarioModel();

        // CORREÇÃO 1: Trata o CPF removendo pontos e traços vindos do JavaScript
        // CORREÇÃO 2: Busca por 'USR_CPF' que é o name original do formulário HTML
        $cpfPost = $this->request->getPost('USR_CPF') ?? $this->request->getPost('USU_CPF');
        $cpfLimpo = preg_replace('/\D/', '', $cpfPost);

        if (empty($cpfLimpo)) {
            return redirect()->back()->withInput()->with('erro', 'CPF inválido ou não informado.');
        }

        // Verifica se o CPF já existe no banco
        $usuario = $model->where('USU_CPF', $cpfLimpo)->first();

        if ($usuario) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Este CPF já está cadastrado no sistema.');
        }

        // Captura os dados mapeando os names do HTML (USR_...) para as colunas do Banco (USU_...)
        $nome  = $this->request->getPost('USR_NOME')  ?? $this->request->getPost('USU_NOME');
        $email = $this->request->getPost('USR_EMAIL') ?? $this->request->getPost('USU_EMAIL');
        $senha = $this->request->getPost('USR_SENHA') ?? $this->request->getPost('USU_SENHA');
        $data  = $this->request->getPost('USR_DATA_NASC') ?? $this->request->getPost('USU_DATA_NASCIMENTO');
        $empresa = $this->request->getPost('FK_EMP_CNPJ'); // Nulo no cadastro comum, preenchido no admin

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

        // Se for um usuário comum se cadastrando na tela inicial, redireciona para o login
        if ($tipo === 'USUARIO') {
            return redirect()->to('/login')->with('sucesso', 'Cadastro realizado! Faça seu login.');
        }

        // Se for um Admin criando outro na área restrita, volta com mensagem
        return redirect()->back()->with('sucesso', 'Cadastro realizado com sucesso!');
    }
}