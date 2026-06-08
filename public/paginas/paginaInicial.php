<?php
session_start();


if (!isset($_SESSION["usuario"])) {
  unset($_SESSION["usuario"]);
    header("Location: paginaEntrar.php");
    exit();
}


$nome = $_SESSION["usuario"]["nome"] ?? null;
$id = $_SESSION["usuario"]["id"] ?? null;
$email = $_SESSION["usuario"]["email"] ?? null;


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Biblioteca</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg,#0F0F0F,#1A0B2E,#4C1D95);
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
}

/* Efeitos de fundo */
.circle{
    position:absolute;
    width:300px;
    height:300px;
    border-radius:50%;
    background:rgba(168,85,247,.08);
    backdrop-filter:blur(10px);
}

.circle:nth-child(1){
    top:-100px;
    left:-100px;
}

.circle:nth-child(2){
    bottom:-100px;
    right:-100px;
}

.container{
    width:500px;
    background:#111111;
    border:1px solid rgba(168,85,247,.2);
    border-radius:25px;
    padding:40px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,.5);
    z-index:1;
}

h1{
    color:#C084FC;
    margin-bottom:30px;
    font-size:2rem;
}

.menu{
    display:flex;
    flex-direction:column;
    gap:15px;
}

.menu a{
    text-decoration:none;
    padding:15px;
    border-radius:14px;
    background:#1A1A1A;
    color:#F3E8FF;
    font-weight:600;
    border:1px solid rgba(168,85,247,.15);
    transition:.3s;
}

.menu a:hover{
    background:linear-gradient(135deg,#7E22CE,#A855F7);
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(168,85,247,.3);
}

.adm{
    margin-top:10px;
    background:linear-gradient(135deg,#9333EA,#C084FC) !important;
    color:white !important;
}

@media(max-width:600px){
    .container{
        width:90%;
        padding:30px;
    }
}
</style>
</head>
<body>

<div class="circle"></div>
<div class="circle"></div>

<div class="container">

    <h1>📚 Bem-vindo, <?php echo $nome; ?></h1>

    <div class="menu">
        <a href="paginaLivro.php?genero=AVENTURA">🗺️ Aventura</a>
        <a href="paginaLivro.php?genero=BIOGRAFIA">👤 Biografia</a>
        <a href="paginaLivro.php?genero=FICCAO">🚀 Ficção Científica</a>
        <a href="paginaLivro.php?genero=FANTASIA">🧙 Fantasia</a>
        <a href="paginaLivro.php?genero=ROMANCE">❤️ Romance</a>
        <a href="paginaLivro.php?genero=TERROR">👻 Terror</a>
        <a href="paginaBiblioteca.php">Minha Biblioteca</a>
    </div>

</div>

</body>
</html>