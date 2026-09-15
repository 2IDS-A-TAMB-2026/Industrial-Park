<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    /**
     * GET /perfil
     * Identifica o tipo do usuário e carrega a view correspondente automaticamente.
     */
    public function index()
    {
        $usuario = $this->getUsuarioAutenticado();

        if (!$usuario) {
            return redirect()->to('/login')->with('erro', 'Faça login para acessar o perfil.');
        }

        $dados['usuario'] = $usuario;
        $tipo = $usuario['USU_TIPO'] ?? session()->get('USU_TIPO') ?? session()->get('tipo');
        $tipoUpper = strtoupper((string)$tipo);

        switch ($tipoUpper) {
            case 'PORTEIRO':
            case '3':
                return view('sistema/perfil/perfil-porteiro', $dados);

            case 'ADMIN':
            case 'ADMINISTRADOR':
            case '2':
                return view('sistema/perfil/perfil-admin', $dados);

            case 'SUPER ADMIN':
            case 'SUPERADMIN':
            case '1':
                return view('sistema/perfil/perfil-superadm', $dados);

            default:
                return view('sistema/perfil/perfil-usuario', $dados);
        }
    }

    /**
     * Métodos específicos para chamadas diretas de rota:
     * Ex: /perfil-porteiro, /perfil-admin, /perfil-superadm, /perfil-usuario
     */
    public function porteiro()
    {
        return $this->carregarViewEspecial('sistema/perfil/perfil-porteiro');
    }

    public function admin()
    {
        return $this->carregarViewEspecial('sistema/perfil/perfil-admin');
    }

    public function superadm()
    {
        return $this->carregarViewEspecial('sistema/perfil/perfil-superadm');
    }

    public function usuario()
    {
        return $this->carregarViewEspecial('sistema/perfil/perfil-usuario');
    }

    /**
     * POST /perfil/atualizar
     * Atualiza dados cadastrais, senha e upload de foto.
     */
    public function atualizar()
    {
        $usuarioModel = new UsuarioModel();
        $cpf = session()->get('USU_CPF') ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login');
        }

        // Dados permitidos para alteração
        $dados = [
            'USU_NOME'  => $this->request->getPost('USU_NOME'),
            'USU_EMAIL' => $this->request->getPost('USU_EMAIL')
        ];

        // Trata alteração de senha
        $senha = $this->request->getPost('USU_SENHA');
        if (!empty($senha)) {
            $dados['USU_SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        // Trata upload da foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $novoNome = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads', $novoNome);
            $dados['USU_FOTO'] = $novoNome;
        }

        // Atualiza no banco
        $usuarioModel->update($cpf, $dados);

        // Atualiza a sessão atual para refletir as mudanças no layout
        $usuarioAtualizado = $usuarioModel->find($cpf);
        session()->set([
            'USU_CPF'   => $usuarioAtualizado['USU_CPF'],
            'cpf'       => $usuarioAtualizado['USU_CPF'],
            'USU_NOME'  => $usuarioAtualizado['USU_NOME'],
            'nome'      => $usuarioAtualizado['USU_NOME'],
            'USU_EMAIL' => $usuarioAtualizado['USU_EMAIL'],
            'USU_FOTO'  => $usuarioAtualizado['USU_FOTO'] ?? null
        ]);

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Métodos Auxiliares Privados
     */
    private function getUsuarioAutenticado()
    {
        $cpf = session()->get('USU_CPF') ?? session()->get('cpf');

        if (!$cpf) {
            return null;
        }

        $usuarioModel = new UsuarioModel();
        return $usuarioModel->find($cpf);
    }

    private function carregarViewEspecial(string $viewPath)
    {
        $usuario = $this->getUsuarioAutenticado();

        if (!$usuario) {
            return redirect()->to('/login')->with('erro', 'Faça login para acessar o perfil.');
        }

        return view($viewPath, ['usuario' => $usuario]);
    }
}