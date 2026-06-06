<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: /paginas/paginaEntrar.php");
    exit();
}


$role = $_SESSION["usuario"]["role"] ?? null;

if ($role !== "admin") {
    header("Location: paginaInici   al.php?erro=acesso_negado");
    exit();
}


$nome = $_SESSION["nome"];
echo $nome;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1E3A8A, #2563EB);
            overflow: hidden;
        }

        /* Livros decorativos */
        .book {
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .book:nth-child(1) {
            top: -50px;
            left: -50px;
        }

        .book:nth-child(2) {
            bottom: -70px;
            right: -70px;
        }

        .login-container {
            width: 400px;
            background: #F8FAFC;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 10;
        }

        .logo {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 10px;
        }

        h1 {
            text-align: center;
            color: #1E3A8A;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748B;
            margin-bottom: 30px;
            font-size: .95rem;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #E2E8F0;
            border-radius: 14px;
            font-size: 1rem;
            transition: .3s;
            background: #fff;
        }

        input:focus {
            outline: none;
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .15);
        }

        button {
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 14px;
            background: #10B981;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
        }

        button:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #2563EB;
            text-decoration: none;
            font-size: .9rem;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .quote {
            text-align: center;
            margin-top: 25px;
            color: #64748B;
            font-size: .85rem;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="book"></div>
    <div class="book"></div>

    <div class="login-container">

        <div class="logo">📚</div>

        <h1>Bem-vindo</h1>
        <p class="subtitle">Deletar</p>

        <form action="../controle/processarDeletar.php" method="post" enctype="multipart/form-data">

            <div class="input-group">
                <label>ID</label>
                <input type="number" placeholder="ID" name="id" required>
            </div>
                <button type="submit" name="submit">
                    Confirmar
                </button>
        </form>

    </div>

</body>

</html>