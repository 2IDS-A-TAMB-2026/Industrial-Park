<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'USUARIO';
    protected $primaryKey = 'USU_CPF';
    protected $returnType = 'array';

    protected $allowedFields = [
        'USU_CPF',
        'USU_NOME',
        'USU_EMAIL',
        'USU_SENHA',
        'USU_DATA_NASCIMENTO',
        'USU_TIPO',
        'FK_EMP_CNPJ',
        'TOKEN_RECUPERACAO',
        'USU_FOTO'
    ];

    public function getUserByEmail($email)
    {
        return $this->where(
            'USU_EMAIL',
            trim($email)
        )->first();
    }

    public function verificarSenha($usuario, $senha)
    {
        if (!$usuario || !isset($usuario['USU_SENHA'])) {
            return false;
        }

        $senhaBanco = (string) $usuario['USU_SENHA'];
        $senhaDigitada = (string) $senha;

        // Senha já está em hash
        if (password_verify($senhaDigitada, $senhaBanco)) {

            // Atualiza o hash se necessário
            if (password_needs_rehash(
                $senhaBanco,
                PASSWORD_DEFAULT
            )) {
                $this->atualizarSenha(
                    $usuario['USU_CPF'],
                    $senhaDigitada
                );
            }

            return true;
        }

        /*
         * Compatibilidade com os usuários antigos
         * cadastrados no SQL com senha em texto puro.
         */
        if (hash_equals($senhaBanco, $senhaDigitada)) {

            // Converte automaticamente para hash
            $this->atualizarSenha(
                $usuario['USU_CPF'],
                $senhaDigitada
            );

            return true;
        }

        return false;
    }

    public function atualizarSenha($cpf, $senha)
    {
        $hash = password_hash(
            $senha,
            PASSWORD_DEFAULT
        );

        return $this->where(
            'USU_CPF',
            $cpf
        )->set([
            'USU_SENHA' => $hash
        ])->update();
    }
}