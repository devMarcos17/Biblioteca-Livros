<?php

use Marcos\Modelo\AutenticarUsuario;
use Marcos\Modelo\Usuario;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nome = "";

    $usuario = new Usuario($nome, $email, $senha);

    $autenticar = new AutenticarUsuario($conexao);
    $sucesso = $autenticar->autenticarUsuario($usuario);
    if($sucesso){
       $_SESSION["usuario"] = [
        "id" => $sucesso["id"],
        "nome" => $sucesso["nome"],
        "email" => $sucesso["email"],
        "role" => $sucesso["role"],
    ];
        header("Location: ../paginas/paginaInicial.php?autenticar=true");
        exit();
    }
   unset($_SESSION["usuario"]);
    header("Location: ../paginas/paginaEntrar.php?credenciaisInvalida");
    exit();
}
?>