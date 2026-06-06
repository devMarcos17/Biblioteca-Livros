<?php

use Marcos\Modelo\CadastrarLivro;
use Marcos\Modelo\Livro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $autor = $_POST["autor"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $nomeArquivo = $_POST["nomeArquivo"];

    $imagem = $_FILES["imagem"]["name"];
    $tmp = $_FILES["imagem"]["tmp_name"];
    $destino = "../uploads/" . $imagem;



    move_uploaded_file($tmp, $destino);

   $urlArquivo = $_FILES["url_arquivo"]["name"];
$tmpUrl = $_FILES["url_arquivo"]["tmp_name"];
$destinoUrl = "../uploads/" . $urlArquivo;

if (move_uploaded_file($tmpUrl, $destinoUrl)) {
    echo "PDF enviado com sucesso";
} else {
    echo "ERRO AO ENVIAR PDF";
    var_dump($_FILES["url_arquivo"]);
}

    $livro = new Livro($nome, $genero, $autor, $preco, $imagem, $descricao, $nomeArquivo, $urlArquivo);
    $cadastrar = new CadastrarLivro($conexao);
    $sucesso = $cadastrar->cadastrarLivro($livro);

    if ($sucesso) {
        header("Location: /paginas/paginaInicial.php?livroCadastrado=true");
        exit();
    }
    header("Location: /paginas/paginaInicial.php?livroCadastrado=false");
    exit();
}
