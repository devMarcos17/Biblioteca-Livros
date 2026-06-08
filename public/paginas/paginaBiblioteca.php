<?php

use Marcos\Modelo\ListarLivro;
use Marcos\Modelo\LivroUsuario;
use Marcos\Modelo\Usuario;

require_once __DIR__ . "/../../config/autoload.php";
require_once __DIR__ . "/../../config/config.php";

session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: paginaEntrar.php");
    exit();
}
$id = $_GET['id'] ?? null;
$idUsuario = $_SESSION["usuario"]["id"];



$listar = new ListarLivro($conexao);


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['busca'])) {
        $livros = $listar->buscarLivro($_POST['busca']);
    } else {
        $livros = $listar->listarBiblioteca($idUsuario);
    }
} else {
    $livros = $listar->listarBiblioteca($idUsuario);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
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

        /* CONTAINER AJUSTADO: 200px para os cards ficarem menores */
        .container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: #111111;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(168, 85, 247, .2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .4);
            transition: .3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none; /* Remove sublinhado se o card for um link */
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: #A855F7;
            box-shadow: 0 15px 40px rgba(168, 85, 247, .25);
        }

        /* IMAGEM AJUSTADA: Altura reduzida para 240px */
        .card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }

        .card-content {
            padding: 15px;
        }

        .card-id {
            display: inline-block;
            background: linear-gradient(135deg, #7E22CE, #A855F7);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .75rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #F3E8FF;
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .info {
            margin-bottom: 8px;
            color: #D4D4D8;
            font-size: .88rem;
        }

        .info strong {
            color: #C084FC;
        }

        /* Mensagem de Biblioteca Vazia */
        .empty-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #D4D4D8;
            border: 2px dashed rgba(168, 85, 247, 0.3);
            border-radius: 15px;
            background: rgba(17, 17, 17, 0.6);
        }

        @media (max-width:600px) {
            h1 {
                font-size: 2rem;
            }
            .card img {
                height: 220px;
            }
        }

        /* BARRA DE BUSCA ROXA */
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
            background-color: #111111;
            border: 2px solid rgba(168, 85, 247, 0.3);
            border-radius: 30px;
            outline: none;
            font-size: 16px;
            color: #ffffff;
            transition: 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .search-form input[type="text"]:focus {
            border-color: #A855F7;
            box-shadow: 0 0 12px rgba(168, 85, 247, 0.4);
        }

        .search-form input[type="submit"] {
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(135deg, #7E22CE, #A855F7);
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .search-form input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(168, 85, 247, 0.4);
        }
    </style>
</head>
<body>

    <h1>Minha Biblioteca</h1>

    <form class="search-form" action="" method="post">
        <input type="text" name="busca" placeholder="Pesquisar...">
        <input type="submit" value="Buscar">
    </form>

    <div class="container">
        <?php if (empty($livros)): ?>
            <div class="empty-message">
                <p>Sua biblioteca está vazia. Salve alguns livros para começar!</p>
            </div>
        <?php else: ?>
            <?php foreach($livros as $livro): ?>
                
                <a href="paginaDetalheLivro.php?id=<?php echo $livro['id']; ?>" class="card">
                    
                    <img src="../uploads/<?php echo $livro['imagem']; ?>" alt="<?php echo $livro['nome']; ?>">
                    
                    <div class="card-content">
                        <span class="card-id"><?php echo htmlspecialchars($livro["genero"]); ?></span>
                        
                        <h3 class="card-title" title="<?php echo htmlspecialchars($livro["nome"]); ?>">
                            <?php echo htmlspecialchars($livro["nome"]); ?>
                        </h3>
                        
                        <p class="info">Autor: <strong><?php echo htmlspecialchars($livro["autor"]); ?></strong></p>
                        <p class="info">Preço: <strong style="color: #4ade80;">R$ <?php echo number_format($livro["preco"], 2, ',', '.'); ?></strong></p>
                    </div>
                    
                </a>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>