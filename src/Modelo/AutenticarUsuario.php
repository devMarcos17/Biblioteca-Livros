<?php
namespace Marcos\Modelo;

use PDO;

class AutenticarUsuario
{
    private PDO $conexao;
    public function __construct(
        PDO $conexao
    )
    {
        $this->conexao = $conexao;
    }

    public function autenticarUsuario(Usuario $usuario)
    {
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();

        $query = "SELECT id, nome, email, senha, role FROM usuarios WHERE email = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        
        $bancoUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($bancoUsuario && password_verify($senha, $bancoUsuario["senha"])){
            return $bancoUsuario;
        }
        return false;
}
}
?>