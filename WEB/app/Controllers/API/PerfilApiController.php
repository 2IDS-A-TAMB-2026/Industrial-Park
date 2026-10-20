<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class PerfilApiController extends BaseController
{
    use ResponseTrait;

    /**
     * ============================================================
     * PARTE DO SITE
     * ============================================================
     */

    /**
     * Rota principal do perfil do site.
     *
     * GET /perfil
     */
    public function index()
    {
        $cpf = session()->get('USU_CPF')
            ?? session()->get('USR_CPF')
            ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login')
                ->with('erro', 'Usuário não autenticado.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($cpf);

        if (!$usuario) {
            return redirect()->to('/login')
                ->with('erro', 'Usuário não encontrado.');
        }

        $data['usuario'] = $usuario;

        $tipo = $usuario['USU_TIPO']
            ?? session()->get('USU_TIPO')
            ?? session()->get('tipo');

        $tipoUpper = strtoupper((string) $tipo);

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

            default:
                return view('perfil-usuario', $data);
        }
    }

    /**
     * Perfil específico de porteiro.
     */
    public function porteiro()
    {
        return $this->carregarPerfil('perfil-porteiro');
    }

    /**
     * Perfil específico de administrador.
     */
    public function admin()
    {
        return $this->carregarPerfil('perfil-admin');
    }

    /**
     * Perfil específico de super administrador.
     */
    public function superadm()
    {
        return $this->carregarPerfil('perfil-superadm');
    }

    /**
     * Perfil específico de usuário comum.
     */
    public function usuario()
    {
        return $this->carregarPerfil('perfil-usuario');
    }

    /**
     * Carrega o perfil para as páginas do site.
     */
    private function carregarPerfil(string $viewName)
    {
        $cpf = session()->get('USU_CPF')
            ?? session()->get('USR_CPF')
            ?? session()->get('cpf');

        if (!$cpf) {
            return redirect()->to('/login')
                ->with('erro', 'Usuário não autenticado.');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($cpf);

        if (!$usuario) {
            return redirect()->to('/login')
                ->with('erro', 'Usuário não encontrado.');
        }

        return view($viewName, [
            'usuario' => $usuario
        ]);
    }

    /**
     * ============================================================
     * API DO FLUTTER
     * ============================================================
     */

    /**
     * GET /api/perfil/{cpf}
     *
     * Busca os dados do usuário através do CPF
     * recebido pela URL.
     *
     * Exemplo:
     * GET /api/perfil/12345678900
     */
    public function exibir($cpf)
    {
        // Verifica se o CPF foi informado
        if (empty($cpf)) {
            return $this->respond([
                'status'   => 400,
                'mensagem' => 'CPF não informado.'
            ], 400);
        }

        // Busca o usuário pelo CPF
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel->find($cpf);

        // Usuário não encontrado
        if (!$usuario) {
            return $this->respond([
                'status'   => 404,
                'mensagem' => 'Usuário não encontrado.'
            ], 404);
        }

        // Nunca enviar a senha para o Flutter
        unset($usuario['USU_SENHA']);

        // Retorna os dados
        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Perfil carregado com sucesso.',
            'usuario'  => $usuario
        ], 200);
    }

    /**
     * PUT /api/perfil/{cpf}
     *
     * Atualiza os dados do usuário através do CPF
     * recebido pela URL.
     */
    public function atualizar($cpf)
    {
        // Verifica se o CPF foi informado
        if (empty($cpf)) {
            return $this->respond([
                'status'   => 400,
                'mensagem' => 'CPF não informado.'
            ], 400);
        }

        $usuarioModel = new UsuarioModel();

        // Verifica se o usuário existe
        $usuario = $usuarioModel->find($cpf);

        if (!$usuario) {
            return $this->respond([
                'status'   => 404,
                'mensagem' => 'Usuário não encontrado.'
            ], 404);
        }

        /*
         * Recebe os dados enviados pelo Flutter.
         */
        $dados = $this->request->getJSON(true);

        if (!is_array($dados)) {
            $dados = $this->request->getPost();
        }

        if (!is_array($dados)) {
            return $this->respond([
                'status'   => 400,
                'mensagem' => 'Dados inválidos.'
            ], 400);
        }

        /*
         * Campos que podem ser alterados.
         */
        $dadosAtualizacao = [];

        // Nome
        if (isset($dados['USU_NOME'])) {

            $nome = trim((string) $dados['USU_NOME']);

            if ($nome === '') {
                return $this->respond([
                    'status'   => 400,
                    'mensagem' => 'O nome é obrigatório.'
                ], 400);
            }

            $dadosAtualizacao['USU_NOME'] = $nome;
        }

        // E-mail
        if (isset($dados['USU_EMAIL'])) {

            $email = trim((string) $dados['USU_EMAIL']);

            if ($email === '') {
                return $this->respond([
                    'status'   => 400,
                    'mensagem' => 'O e-mail é obrigatório.'
                ], 400);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->respond([
                    'status'   => 400,
                    'mensagem' => 'Informe um e-mail válido.'
                ], 400);
            }

            $dadosAtualizacao['USU_EMAIL'] = $email;
        }

        // Telefone
        if (array_key_exists('USU_TELEFONE', $dados)) {

            $dadosAtualizacao['USU_TELEFONE'] =
                trim((string) $dados['USU_TELEFONE']);
        }

        // Nenhum campo informado
        if (empty($dadosAtualizacao)) {
            return $this->respond([
                'status'   => 400,
                'mensagem' => 'Nenhum dado para atualizar.'
            ], 400);
        }

        /*
         * Atualiza utilizando o CPF recebido pela URL.
         */
        $atualizado = $usuarioModel->update(
            $cpf,
            $dadosAtualizacao
        );

        if (!$atualizado) {
            return $this->respond([
                'status'   => 500,
                'mensagem' => 'Não foi possível atualizar o perfil.'
            ], 500);
        }

        /*
         * Busca novamente os dados atualizados.
         */
        $usuarioAtualizado = $usuarioModel->find($cpf);

        if (!$usuarioAtualizado) {
            return $this->respond([
                'status'   => 404,
                'mensagem' =>
                    'Usuário não encontrado após atualização.'
            ], 404);
        }

        // Nunca enviar a senha
        unset($usuarioAtualizado['USU_SENHA']);

        return $this->respond([
            'status'   => 200,
            'mensagem' => 'Perfil atualizado com sucesso.',
            'usuario'  => $usuarioAtualizado
        ], 200);
    }
}