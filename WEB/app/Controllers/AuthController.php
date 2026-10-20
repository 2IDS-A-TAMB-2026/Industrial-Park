<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AuthController extends BaseController
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        return view('sistema/auth');
    }

    public function autenticar()
    {
        $email = trim((string) $this->request->getPost('USU_EMAIL'));
        $senha = (string) $this->request->getPost('USU_SENHA');

        if ($email === '' || $senha === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Preencha o e-mail e a senha.');
        }

        $usuario = $this->authModel->getUserByEmail($email);

        if (!$usuario) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'E-mail ou senha incorretos.');
        }

        /*
         * Verifica a senha.
         *
         * O banco atualmente possui usuários antigos
         * com senha em texto puro. O método verificarSenha()
         * também trata esses usuários e converte a senha
         * para hash automaticamente.
         */
        if (!$this->authModel->verificarSenha($usuario, $senha)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'E-mail ou senha incorretos.');
        }

        // Regenera a sessão por segurança
        session()->regenerate();

        // Dados da sessão
        session()->set([
            'cpf'    => $usuario['USU_CPF'],
            'nome'   => $usuario['USU_NOME'],
            'tipo'   => $usuario['USU_TIPO'],
            'email'  => $usuario['USU_EMAIL'],
            'logado' => true
        ]);

        // Redirecionamento conforme o tipo de usuário
switch (strtoupper(trim($usuario['USU_TIPO']))) {

    case 'SUPERADM':
        return redirect()
            ->to('/dashboard-superadm')
            ->with('sucesso', 'Bem-vindo, Super Administrador!');

    case 'ADMIN':
        return redirect()
            ->to('/dashboard-admin')
            ->with('sucesso', 'Bem-vindo, Administrador!');

    case 'PORTEIRO':
        return redirect()
            ->to('/dashboard-porteiro')
            ->with('sucesso', 'Bem-vindo, Porteiro!');

    case 'USUARIO':
        return redirect()
            ->to('/dashboard-usu')
            ->with('sucesso', 'Bem-vindo ao Industrial Park!');

    default:
        session()->destroy();

        return redirect()
            ->back()
            ->with('erro', 'Tipo de usuário inválido.');
}

    }
    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with('sucesso', 'Logout realizado com sucesso.');
    }

    public function alterarSenha()
    {
        return view('sistema/alterar_senha');
    }

    public function salvarNovaSenha()
    {
        $email = trim((string) $this->request->getPost('USU_EMAIL'));
        $senha = (string) $this->request->getPost('USU_SENHA');
        $confirmar = (string) $this->request->getPost('CONFIRMAR_SENHA');

        if ($email === '' || $senha === '' || $confirmar === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Preencha todos os campos.');
        }

        if (strlen($senha) < 6) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'A senha deve possuir pelo menos 6 caracteres.');
        }

        if ($senha !== $confirmar) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'As senhas não coincidem.');
        }

        $usuario = $this->authModel->getUserByEmail($email);

        if (!$usuario) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'E-mail não encontrado.');
        }

        $resultado = $this->authModel->atualizarSenha(
            $usuario['USU_CPF'],
            $senha
        );

        if (!$resultado) {
            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível alterar a senha.');
        }

        return redirect()
            ->to('/login')
            ->with('sucesso', 'Senha alterada com sucesso.');
    }
}