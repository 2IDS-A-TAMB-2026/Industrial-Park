<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    /**
     * Rota principal: GET /perfil
     * Identifica automaticamente o tipo do usuário logado e carrega a tela correspondente.
     */
    public function index()
    {
        $cpf = session()->get('USU_CPF') ?? session()->get('USR_CPF') ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login')->with('erro', 'Usuário não autenticado.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($cpf);

        if (!$usuario) {
            return redirect()->to('/login')->with('erro', 'Usuário não encontrado.');
        }

        $data['usuario'] = $usuario;

        // Pega o tipo de usuário (da sessão ou do banco)
        $tipo = $usuario['USU_TIPO'] ?? session()->get('USU_TIPO') ?? session()->get('tipo');
        $tipoUpper = strtoupper((string)$tipo);

        // Direciona para a view correspondente usando traço (-)
        switch ($tipoUpper) {
            case 'PORTEIRO':
            case '3':
                return view('perfil-porteiro', $data);

            case 'ADMIN':
            case 'ADMINISTRADOR':
            case '2':
                return view('perfil-admin', $data);

            case 'SUPER ADMIN':
            case 'SUPERADMIN':
            case '1':
                return view('perfil-superadm', $data);

            default: // Usuário comum
                return view('perfil-usuario', $data);
        }
    }

    // Métodos específicos caso queira usar URLs separadas (/perfil/porteiro, /perfil/admin, etc.)
    public function porteiro()
    {
        return $this->carregarPerfil('perfil-porteiro');
    }

    public function admin()
    {
        return $this->carregarPerfil('perfil-admin');
    }

    public function superadm()
    {
        return $this->carregarPerfil('perfil-superadm');
    }

    public function usuario()
    {
        return $this->carregarPerfil('perfil-usuario');
    }

    private function carregarPerfil(string $viewName)
    {
        $cpf = session()->get('USU_CPF') ?? session()->get('USR_CPF') ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login')->with('erro', 'Usuário não autenticado.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($cpf);

        return view($viewName, ['usuario' => $usuario]);
    }
}