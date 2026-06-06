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
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #0F0F0F, #1A0B2E, #4C1D95);
    overflow: hidden;
}

/* fundo decorativo */
.book {
    position: absolute;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: rgba(168, 85, 247, 0.08);
    filter: blur(2px);
}

.book:nth-child(1) {
    top: -60px;
    left: -60px;
}

.book:nth-child(2) {
    bottom: -80px;
    right: -80px;
}

/* container igual “card premium” */
.login-container {
    width: 420px;
    background: #111111;
    padding: 40px;
    border-radius: 20px;
    border: 1px solid rgba(168, 85, 247, .2);
    box-shadow: 0 10px 40px rgba(0, 0, 0, .5);
    position: relative;
    z-index: 10;
}

/* logo */
.logo {
    text-align: center;
    font-size: 3rem;
    margin-bottom: 10px;
}

/* títulos */
h1 {
    text-align: center;
    color: #C084FC;
    margin-bottom: 8px;
}

.subtitle {
    text-align: center;
    color: #D4D4D8;
    margin-bottom: 25px;
    font-size: .95rem;
}

/* inputs */
.input-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 6px;
    color: #C084FC;
    font-weight: 600;
    font-size: .9rem;
}

input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid rgba(168, 85, 247, .25);
    background: #0F0F0F;
    color: #fff;
    outline: none;
    transition: .3s;
}

input:focus {
    border-color: #A855F7;
    box-shadow: 0 0 10px rgba(168, 85, 247, .3);
}

/* botão */
button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #7c3aed, #4f46e5);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: .3s;
    margin-top: 10px;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(124, 58, 237, .4);
}

/* links */
.links {
    text-align: center;
    margin-top: 15px;
}

.links a {
    color: #A855F7;
    text-decoration: none;
    font-size: .9rem;
}

.links a:hover {
    text-decoration: underline;
}

/* frase */
.quote {
    text-align: center;
    margin-top: 20px;
    color: #9CA3AF;
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
        <p class="subtitle">Cadastrar</p>

        <form action="../controle/processarAtualizar.php" method="post" enctype="multipart/form-data">

            <div class="input-group">
                <label>ID</label>
                <input type="number" placeholder="" name="id" required>
            </div>
            <div class="input-group">
                <label>Nome</label>
                <input type="text" placeholder="" name="nome" required>
            </div>
            <div class="input-group">
                <label>Genero</label>
                <input type="text" placeholder="" name="genero" required>
            </div>

            <div class="input-group">
                <label>Autor</label>
                <input type="text" placeholde="" name="autor" required>
            </div>
            <div class="input-group">
                <label>Preço</label>
                <input type="number" placeholde="" name="preco" required>
            </div>
            <div class="input-group">
                <label>Foto</label>
                <input type="file" placeholder="" name="imagem" required>
            </div>
              <div class="input-group">
                <label>Descricao</label>
                <input type="text" placeholder="" name="descricao" required>
            </div>
             <div class="input-group">
                <label>nome do Arquivo</label>
                <input type="text" placeholder="" name="nomeArquivo" required>
            </div>
            <div class="input-group">
                <label>Arquivo PDF</label>
                <input type="file" placeholder="" name="url_arquivo" required>
            </div>

                <button type="submit" name="submit">
                    Confirmar
                </button>
        </form>

    </div>

</body>

</html>