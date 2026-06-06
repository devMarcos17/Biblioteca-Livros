<?php

use Marcos\Modelo\CadastrarUsuario;
use Marcos\Modelo\Usuario;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nome = $_POST["nome"];
    

    $usuario = new Usuario($nome, $email, $senha, "usuario");
    
    $cadastrar = new CadastrarUsuario($conexao);
    $sucesso = $cadastrar->cadastrarUsuario($usuario);
    if($sucesso){
        header("Location: /paginas/paginaEntrar.php?cadastrar=true");
        exit();
    }
    header("Location: /paginas/paginaEntrar.php?cadastrar=false");
    exit();
}
?>