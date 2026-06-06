<?php
namespace Marcos\Modelo;

use PDO;

class CadastrarUsuario
{
    private PDO $conexao;
    public function __construct(
        PDO $conexao
    )
    {
        $this->conexao = $conexao;
    }

    public function cadastrarUsuario(Usuario $usuario): bool
    {
        $nome = $usuario->nome;
        $email = $usuario->getEmail();
        $senha = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $senha);

        $sucesso = $stmt->execute();
        if($sucesso){
            return true;
        }
        return false;
    }
}
?>