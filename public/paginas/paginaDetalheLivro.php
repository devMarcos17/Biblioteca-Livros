<?php

use Marcos\Modelo\BaixarArquivoPdf;
use Marcos\Modelo\ListarLivro;
use Marcos\Modelo\Livro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

session_start();

$id = $_GET['id'] ?? null;
$idUsuario = $_SESSION["usuario"]["id"];

if (!$id) {
    die("ERRO: ID DO LIVRO NAO FOI ENCONTRADO");
}
$listar = new ListarLivro($conexao);
$livros = $listar->listarLivroID($id);
foreach ($livros as $livro) {
}

$baixarArquivo = new BaixarArquivoPdf($conexao);
$dadosPDF = $baixarArquivo->baixarPDF((string)$id);
if ($livro) {
    $nome = $dadosPDF['nome_arquivo'];
    $url  = $dadosPDF['url_arquivo'];
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
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
        }

        .card {
            background: #111111;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(168, 85, 247, .2);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .35);
            transition: .3s;
            width: 100%;
            /* AJUSTADO: Card maior para acomodar melhor os detalhes e botões */
            max-width: 400px; 
            margin: auto;
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: #A855F7;
            box-shadow: 0 15px 40px rgba(168, 85, 247, .25);
        }

        .card img {
            max-width: 100%;
            width: auto;
            /* AJUSTADO: Altura proporcional ao novo tamanho do card */
            max-height: 450px; 
            display: block;
            margin: 20px auto;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            object-fit: contain;
        }

        .card-content {
            padding: 24px;
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
            font-size: 1.6rem;
            font-weight: 700;
            color: #F3E8FF;
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 12px;
            color: #D4D4D8;
            font-size: .95rem;
            line-height: 1.5;
        }

        .info strong {
            color: #C084FC;
        }

        /* AJUSTADO: Grid de 2 colunas para alinhar os botões perfeitamente */
        .card-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 25px;
        }

        /* AJUSTADO: Botões flexíveis com preenchimento idêntico */
        .btn-card {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            transition: 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            height: 100%;
        }

        .btn-card:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.4);
        }

        /* Estilo customizado para o botão de remoção */
        .btn-card.danger {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
        }
        .btn-card.safe{
            background: linear-gradient(135deg, #179030, #128f38);
        }
        
        .btn-card.danger:hover {
            box-shadow: 0 6px 18px rgba(239, 68, 68, 0.4);
        }

        /* Formulários adaptados para ocupar a grade corretamente */
        .card-buttons form {
            margin: 0;
            width: 100%;
        }

        @media (max-width:600px) {
            h1 {
                font-size: 2rem;
            }
            .card img {
                height: 320px;
            }
        }
    </style>
</head>

<body>

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

                    <div class="card-buttons">
                        <a href="../uploads/<?= $url ?>" download class="btn-card">
                            Baixar PDF
                        </a>

                        <a href="../uploads/<?= $url ?>" target="_blank" class="btn-card">
                            Ver PDF
                        </a>

                        <form action="../controle/processarBiblioteca.php" method="POST">
                            <input type="hidden" name="livro_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="usuario_id" value="<?php echo $idUsuario; ?>">
                            <button type="submit" class="btn-card safe" style="cursor: pointer; border: none;">Salvar</button>
                        </form>

                        <form action="../controle/processarDeletarBibiblioteca.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="btn-card danger" style="cursor: pointer; border: none;">Remover</button>
                        </form>
                    </div>

                </div>
            </div>

        <?php } ?>

    </div>
</body>
</html>