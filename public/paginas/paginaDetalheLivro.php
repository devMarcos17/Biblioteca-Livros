<?php

use Marcos\Modelo\BaixarArquivoPdf;
use Marcos\Modelo\ListarLivro;
use Marcos\Modelo\Livro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

$id = $_GET['id'] ?? null;


if (!$id) {
    die("Livro não encontrado.");
}
$baixarArquivo = new BaixarArquivoPdf($conexao);
$dadosPDF = $baixarArquivo->baixarPDF($id);
if ($livro) {
    $nome = $dadosPDF['nome_arquivo'];
    $url  = $dadosPDF['url_arquivo'];
}

$listar = new ListarLivro($conexao);
$livros = $listar->listarLivroID($id);
foreach ($livros as $livro) {
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0F0F0F, #1A0B2E, #4C1D95);
            min-height: 100vh;
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #C084FC;
            font-size: 2.5rem;
            text-shadow: 0 0 20px rgba(168, 85, 247, .3);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: #111111;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(168, 85, 247, .2);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .35);
            transition: .3s;

            /* ALTERADO: Aumentamos o limite para um tamanho confortável de card de livro */
            width: 100%;
            max-width: 320px;
            margin: auto;
            position: relative;
            /* Mantido para os botões absolutos */
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: #A855F7;
            box-shadow: 0 15px 40px rgba(168, 85, 247, .25);
        }

        .card img {
            max-width: 100%;
            width: auto;
            /* Ajuste a altura máxima para a capa não esticar infinitamente */
            max-height: 380px;
            display: block;
            margin: 20px auto;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            object-fit: contain;
            /* Garante que a imagem não distorça */


        }

        .card-content {
            padding: 20px;
        }

        .card-id {
            display: inline-block;
            background: linear-gradient(135deg, #7E22CE, #A855F7);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: .8rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #F3E8FF;
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 10px;
            color: #D4D4D8;
            font-size: .95rem;
        }

        .info strong {
            color: #C084FC;
        }

        @media (max-width:600px) {

            h1 {
                font-size: 2rem;
            }

            .card img {
                height: 280px;
            }

        }

        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 30px 0;
        }

        .search-form input[type="text"] {
            width: 350px;
            padding: 12px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            outline: none;
            font-size: 16px;
            transition: 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .search-form input[type="text"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 12px rgba(79, 70, 229, 0.3);
        }

        .search-form input[type="submit"] {
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .search-form input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
        }

        .search-form input[type="submit"]:active {
            transform: translateY(0);
        }

        .top-buttons {
            position: absolute;
            top: 20px;
            right: 30px;
            display: flex;
            gap: 10px;
        }

        .card {
            position: relative;
            overflow: hidden;
        }

        /* BOTÕES NO CANTINHO DIREITO */
        .card-buttons {
            position: absolute;
            bottom: 12px;
            right: 12px;

            display: flex;
            gap: 8px;
        }

        /* BOTÃO PRINCIPAL */
        .btn-card {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: white;
            text-decoration: none;

            padding: 8px 12px;
            border-radius: 12px;

            font-size: 12px;
            font-weight: bold;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            transition: 0.3s ease;

            backdrop-filter: blur(6px);
        }

        /* HOVER */
        .btn-card:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.4);
        }

        /* BOTÃO SECUNDÁRIO */
        .btn-card.secondary {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* HOVER SECUNDÁRIO */
        .btn-card.secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>

    </div>
    <div class="container">

        <?php foreach ($livros as $item) { ?>

            <div class="card">
                <img class="livro-img"
                    src="../uploads/<?php echo $item['imagem']; ?>"
                    alt="<?php echo $item['nome']; ?>">

                <div class="card-content">

                    <span class="card-id">
                        ID #<?php echo $item['id']; ?>
                    </span>

                    <h2 class="card-title">
                        <?php echo $item['nome']; ?>
                    </h2>

                    <p class="info">
                        <strong>Gênero:</strong>
                        <?php echo $item['genero']; ?>
                    </p>

                    <p class="info">
                        <strong>Autor:</strong>
                        <?php echo $item['autor']; ?>
                    </p>

                    <p class="info">
                        <strong>Preço:</strong>
                        <?php echo $item['preco']; ?> R$
                    </p>
                     <p class="info">
                        <strong>Sobre:</strong>
                        <?php echo $item['descricao']; ?> 
                    </p>

                    <!-- BOTÕES DENTRO DO CARD -->
                    <div class="card-buttons">
                        <a href="../uploads/<?= $livro['url_arquivo'] ?>" download class="btn-card">
                            Baixar PDF
                        </a>
                    </div>

                    <a href="../uploads/<?= $livro['url_arquivo'] ?>" class="btn-card secondary">
                        Ver PDF
                    </a>
                </div>

            </div>
    </div>

<?php } ?>

</div>