<?php

use Marcos\Modelo\DeletarLivro;
use Marcos\Modelo\Livro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $nome = "";
    $genero = "";
    $autor = "";
    $preco = 0;
    $caminhoImagem = "";
    $descricao = "";
    $nomeArquivo = "";
    $urlAquivo = "";


    $livro = new Livro($nome, $genero, $autor, $preco, $caminhoImagem, $descricao, $nomeArquivo, $urlAquivo, $id);
    $deletar = new DeletarLivro($conexao);
    $sucesso = $deletar->deletarLivro($livro);

    if ($sucesso) {
        header("Location: /paginas/paginaInicial.php?deletarLivro=true");
        exit;
    }
    header("Location: /paginas/paginaDeletar.php?deletarLivro=false");
    exit;
}
