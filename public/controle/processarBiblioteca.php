<?php

use Marcos\Modelo\CadastrarLivro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $favorito = ($_POST["livro_id"]);
    $idUsuario = $_POST["usuario_id"];

    


    $cadastrar = new CadastrarLivro($conexao);
    $sucesso = $cadastrar->cadastrarFavorito($idUsuario, $favorito);
    if($sucesso){
        header("Location: /paginas/paginaInicial.php?favorito=true");
        exit;
    }
    header("Location: /paginas/paginaDetalheLivro.php?favorito=false");
    exit;
}


?>