<?php

use Marcos\Modelo\AtualizarLivro;
use Marcos\Modelo\Livro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $autor = $_POST["autor"];
    $preco = $_POST["preco"];
    $id = $_POST["id"];
    $descricao = $_POST["descricao"];
    $nomeArquivo = $_POST["nomeArquivo"];

    $imagem = $_FILES["imagem"]["name"];
    $tmp = $_FILES["imagem"]["tmp_name"];
    $destino = "../uploads/" . $imagem;

    move_uploaded_file($tmp, $destino);

    $urlArquivo = $_FILES["url_arquivo"]["name"];
    $tmpUrl = $_FILES["url_arquivo"]["tmp_name"];
    $urlArquivo = $_FILES["url_arquivo"]["name"];

    move_uploaded_file($tmp, $destino);
    

    $livro = new Livro($nome, $genero, $autor, $preco, $imagem, $descricao, $nomeArquivo, $urlArquivo, $id);
    $atualizar = new AtualizarLivro($conexao);
    $sucesso = $atualizar->atualizarLivro($livro);
    if ($sucesso) {
        header("Location: /paginas/paginaInicial.php?atualizar=true");
        exit;
    }
    header("Location: /paginas/paginaAdmAtualizar.php?atualizar=false");
}
