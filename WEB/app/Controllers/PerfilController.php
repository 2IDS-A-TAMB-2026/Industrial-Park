<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();

        // Pega o CPF da sessão (tenta maiúsculo ou minúsculo)
        $cpf = session()->get('USU_CPF') ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login')->with('erro', 'Faça login para acessar o perfil.');
        }

        // 🔍 Busca os dados atualizados do banco usando o CPF
        $dados['usuario'] = $usuarioModel->find($cpf);

        // Se por algum motivo não achar no banco, desloga por segurança
        if (!$dados['usuario']) {
            return redirect()->to('/login')->with('erro', 'Usuário não encontrado.');
        }

        // Envia os dados para a View
        return view('sistema/perfil/perfil', $dados);
    }

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

        return redirect()->to('/perfil')->with('success', 'Perfil atualizado com sucesso!');
    }
}