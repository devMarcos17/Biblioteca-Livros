<?php

use Marcos\Modelo\DeletarLivro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $usuarioId = $_SESSION["usuario"]["id"];

    $deletar = new DeletarLivro($conexao);
    $sucesso = $deletar->deletarLivroFavorito($usuarioId, $id);
    if ($sucesso) {
        header("Location: /paginas/paginaInicial.php?removido=true");
        exit;
    }
    header("Location: /paginas/paginaInicial.php?removido=true");
    exit;
}
