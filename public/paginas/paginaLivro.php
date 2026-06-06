<?php

use Marcos\Modelo\ListarLivro;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";


$listar = new ListarLivro($conexao);
$genero = isset($_GET['genero']) ? $_GET['genero'] : null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['buscar'])) {
        $livros = $listar->buscarLivro($_POST['buscar']);
    } else {
        $livros = $listar->listarLivro($genero);
    }
} else {
    $livros = $listar->listarLivro($genero);
}
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
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(168, 85, 247, .2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .4);
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: #A855F7;
            box-shadow: 0 15px 40px rgba(168, 85, 247, .25);
        }

        .card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
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
    </style>
    </style>
</head>

<body>

 <h1>📚 <?php echo htmlspecialchars($livro["genero"] ?? 'Biblioteca'); ?></h1>

    <!-- CORREÇÃO 1: O formulário agora fica FORA do container grid, ocupando a largura total e centralizando perfeitamente -->
    <form class="search-form" action="" method="post">
        <input type="text" name="buscar" placeholder="Pesquisar livros...">
        <input type="submit" value="Buscar" name="submit">
    </form>

    <div class="container">

        <?php foreach ($livros as $livro) { ?>
            <!-- CORREÇÃO 2: Removida a div duplicada interna. O próprio link 'a' agora é o card -->
            <a href="paginaDetalheLivro.php?id=<?php echo $livro["id"] ?>" class="card">
                
                <img src="../uploads/<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['nome']; ?>">

                <div class="card-content">
                    <span class="card-id">
                        ID #<?php echo $livro['id']; ?>
                    </span>

                    <h2 class="card-title">
                        <?php echo $livro['nome']; ?>
                    </h2>

                    <p class="info">
                        <strong>Gênero:</strong>
                        <?php echo $livro['genero']; ?>
                    </p>

                    <p class="info">
                        <strong>Autor:</strong>
                        <?php echo $livro['autor']; ?>
                    </p>
                    <p class="info">
                        <strong>Preço:</strong>
                        <?php echo $livro['preco'] . " R$"; ?>
                    </p>
                </div>
            </a> <!-- CORREÇÃO 3: O link fecha aqui, dentro do loop foreach! -->
        <?php } ?>

    </div> <!-- O container grid fecha aqui, abraçando apenas os cards -->

</body>

</html>