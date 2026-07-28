<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('sistema/auth');
    }

    public function autenticar()
    {
        $session = session();
        $model = new AuthModel();

        $email = $this->request->getPost('USU_EMAIL');
        $senha = $this->request->getPost('USU_SENHA');

        $user = $model->getUserByEmail($email);

        // 🚫 usuário não existe
        if (!$user) {
            return redirect()->back()->with('erro', 'Usuário não encontrado');
        }

        // 🚫 senha errada
        if (!password_verify($senha, $user['USU_SENHA'])) {
            return redirect()->back()->with('erro', 'Senha incorreta');
        }

        // ✅ login OK
        $session->set([
            'cpf'    => $user['USU_CPF'],
            'nome'   => $user['USU_NOME'],
            'tipo'   => $user['USU_TIPO'],
            'logado' => true
        ]);

        // 🔀 redirecionamento baseado no tipo
        return redirect()->to($this->getDashboardRoute($user['USU_TIPO']))->with('sucesso', 'Bem-vindo!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    // 📄 Exibe a tela de alteração de senha
    public function alterarSenha()
    {
        return view('sistema/alterar_senha');
    }

    // 💾 Processa a alteração da senha no banco
    public function salvarNovaSenha()
    {
        // 1. Regras de validação (removemos a 'senha_atual')
        $regras = [
            'email'          => 'required|valid_email',
            'nova_senha'     => 'required|min_length[6]',
            'confirma_senha' => 'required|matches[nova_senha]'
        ];

        $mensagens = [
            'email'      => ['required' => 'O e-mail é obrigatório.', 'valid_email' => 'Insira um e-mail válido.'],
            'nova_senha' => [
                'required'   => 'A nova senha é obrigatória.',
                'min_length' => 'A nova senha deve ter pelo menos 6 caracteres.'
            ],
            'confirma_senha' => [
                'required' => 'A confirmação de senha é obrigatória.',
                'matches'  => 'A nova senha e a confirmação não coincidem.'
            ]
        ];

        if (!$this->validate($regras, $mensagens)) {
            return redirect()->back()->withInput()->with('erro', $this->validator->listErrors());
        }

        // 2. Buscar o usuário pelo E-mail enviado pelo formulário
        $email = $this->request->getPost('email');
        $novaSenha  = $this->request->getPost('nova_senha');
        
        $model = new AuthModel();
        $user  = $model->getUserByEmail($email); // Certifique-se de que este método existe no seu Model

        if (!$user) {
            return redirect()->back()->withInput()->with('erro', 'Nenhum usuário encontrado com este e-mail.');
        }

        // 3. Atualizar a senha usando a chave primária correta (supondo que seja o CPF no seu banco)
        $model->update($user['USU_CPF'], [
            'USU_SENHA' => password_hash($novaSenha, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/')->with('sucesso', 'Senha alterada com sucesso! Faça seu login.');
    }
    // 🛠️ Função auxiliar para centralizar as rotas de Dashboard
    private function getDashboardRoute($tipo)
    {
        switch ($tipo) {
            case 'SUPERADM': return '/dashboard-superadm';
            case 'ADMIN':    return '/dashboard-admin';
            case 'PORTEIRO': return '/dashboard-porteiro';
            default:         return '/dashboard-usu'; // Batendo com a nova rota
        }
    }
}