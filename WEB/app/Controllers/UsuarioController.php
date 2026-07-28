<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\EmpresasModel;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $empresaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->empresaModel = new EmpresasModel();
    }

    // ==========================
    // ADMINISTRADORES
    // ==========================

    public function administradores()
{
    $usuarioModel = new \App\Models\UsuarioModel();
    $empresaModel = new \App\Models\EmpresasModel();

    // BUSCA OS ADMINS - Chave alterada para 'admins' (exatamente como está no seu HTML)
    $dados['admins'] = $usuarioModel
        ->select('USUARIO.*, EMPRESA.EMP_NOME')
        ->join('EMPRESA', 'EMPRESA.EMP_CNPJ = USUARIO.FK_EMP_CNPJ', 'left') // 'left' evita sumir com o admin se a empresa estiver nula
        ->where('USU_TIPO', 'ADMIN')
        ->findAll();

    // BUSCA AS EMPRESAS PARA O SELECT
    $dados['empresas'] = $empresaModel->findAll();

    // Carrega a view passando os dados corrigidos
    return view('sistema/admin/cadastro-admin', $dados);
}

    public function inserirAdmin()
    {

        // Captura a senha enviada
        $senha = $this->request->getPost('USU_SENHA');
        
        // Opcional, mas Altamente Recomendável para o TCC: Criptografar a senha se já não fizer isso
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $this->usuarioModel->insert([
            'USU_CPF' => $this->request->getPost('USU_CPF'),
            'USU_NOME' => $this->request->getPost('USU_NOME'),
            'USU_EMAIL' => $this->request->getPost('USU_EMAIL'),
            'USU_SENHA' => $senhaHash,
            'USU_DATA_NASCIMENTO' => $this->request->getPost('USU_DATA_NASCIMENTO'),
            'USU_TIPO' => 'ADMIN',
            'FK_EMP_CNPJ' => $this->request->getPost('FK_EMP_CNPJ')
        ]);

        return redirect()->to('/administradores');
    }

    // ==========================
    // PORTEIROS
    // ==========================

    public function porteiros()
    {
        // Buscando os porteiros com o nome da empresa correspondente
        $dados['porteiros'] = $this->usuarioModel
            ->select('USUARIO.*, EMPRESA.EMP_NOME')
            ->join('EMPRESA', 'EMPRESA.EMP_CNPJ = USUARIO.FK_EMP_CNPJ')
            ->where('USU_TIPO', 'PORTEIRO')
            ->findAll();

        // Buscando as empresas para preencher o <select> do formulário
        $dados['empresas'] = $this->empresaModel->findAll();

        // Certifique-se de que este caminho de View é o correto do seu arquivo
        return view('sistema/porteiros/cadastro-porteiro', $dados);
    }

    public function inserirPorteiro()
    {
        // Remove qualquer ponto, traço ou caractere que não seja número do CPF
        $cpfLimpo = preg_replace('/\D/', '', $this->request->getPost('USU_CPF'));

        // Captura a senha enviada
        $senha = $this->request->getPost('USU_SENHA');
        
        // Opcional, mas Altamente Recomendável para o TCC: Criptografar a senha se já não fizer isso
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $this->usuarioModel->insert([
            'USU_CPF'             => $cpfLimpo, // <--- Aqui usamos o CPF limpo (apenas números)
            'USU_NOME'            => $this->request->getPost('USU_NOME'),
            'USU_EMAIL'           => $this->request->getPost('USU_EMAIL'),
            'USU_SENHA'           => $senhaHash, // mude para $senhaHash se for usar criptografia
            'USU_DATA_NASCIMENTO' => $this->request->getPost('USU_DATA_NASCIMENTO'),
            'USU_TIPO'            => 'PORTEIRO',
            'FK_EMP_CNPJ'         => $this->request->getPost('FK_EMP_CNPJ')
        ]);

        // Redireciona para a rota correta do seu menu lateral (/porteiro)
        return redirect()->to('/porteiro');
    }

    // ==========================
    // VISUALIZAR
    // ==========================

    public function visualizar($cpf)
    {
        $usuario = $this->usuarioModel
            ->select('USUARIO.*, EMPRESA.EMP_NOME')
            ->join('EMPRESA', 'EMPRESA.EMP_CNPJ = USUARIO.FK_EMP_CNPJ')
            ->where('USU_CPF', $cpf)
            ->first();

        return $this->response->setJSON($usuario);
    }

    // ==========================
    // EDITAR
    // ==========================

    public function atualizar($cpf)
    {
        $this->usuarioModel->update($cpf, [
            'USU_NOME' => $this->request->getPost('USU_NOME'),
            'USU_EMAIL' => $this->request->getPost('USU_EMAIL')
            //'USU_DATA_NASCIMENTO' => $this->request->getPost('USU_DATA_NASCIMENTO')
            //'FK_EMP_CNPJ' => $this->request->getPost('FK_EMP_CNPJ')
        ]);

        return redirect()->back();
    }

    // ==========================
    // EXCLUIR
    // ==========================

    public function excluir($cpf)
    {
        $usuario = $this->usuarioModel->find($cpf);

        if (!$usuario) {
            return redirect()->back();
        }

        $tipo = $usuario['USU_TIPO'];

        $this->usuarioModel->delete($cpf);

        if ($tipo == 'ADMIN') {
            return redirect()->to('/admin');
        }

        if ($tipo == 'PORTEIRO') {
            return redirect()->to('/porteiros');
        }

        return redirect()->back();
    }
    public function perfil()
    {
        return view('perfil');
    }
    //atualizar
    public function atualizarPerfil()
    {
        $cpf = session()->get('USU_CPF');

        if (!$cpf) {
            return redirect()->to('/login');
        }

        $dados = [
            'USU_NOME'  => $this->request->getPost('USU_NOME'),
            'USU_EMAIL' => $this->request->getPost('USU_EMAIL')
        ];

        // Atualiza senha somente se foi informada
        $senha = $this->request->getPost('USU_SENHA');

        if (!empty($senha)) {
            $dados['USU_SENHA'] = $senha;
            // Se seu login usa hash:
            // $dados['USU_SENHA'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $this->usuarioModel->update($cpf, $dados);

        // Atualiza dados da sessão
        $usuario = $this->usuarioModel->find($cpf);

        session()->set([
            'USU_NOME'  => $usuario['USU_NOME'],
            'USU_EMAIL' => $usuario['USU_EMAIL']
        ]);

        return redirect()->to('/perfil');
    }
}