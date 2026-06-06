<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0F0F0F,#1A0B2E,#4C1D95);
    overflow:hidden;
}

/* Livros decorativos */
.book{
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(168,85,247,0.08);
    backdrop-filter: blur(10px);
}

.login-container{
    width:400px;
    background:#111111;
    padding:40px;
    border-radius:24px;
    box-shadow:0 20px 50px rgba(0,0,0,0.5);
    border:1px solid rgba(168,85,247,0.2);
    position:relative;
    z-index:10;
}

h1{
    text-align:center;
    color:#C084FC;
    margin-bottom:8px;
}

.subtitle{
    text-align:center;
    color:#A1A1AA;
    margin-bottom:30px;
    font-size:.95rem;
}

label{
    display:block;
    margin-bottom:8px;
    color:#E5E7EB;
    font-weight:600;
}

input{
    width:100%;
    padding:14px 16px;
    border:2px solid #2A2A2A;
    border-radius:14px;
    font-size:1rem;
    transition:.3s;
    background:#1A1A1A;
    color:white;
}

input::placeholder{
    color:#71717A;
}

input:focus{
    outline:none;
    border-color:#A855F7;
    box-shadow:0 0 0 4px rgba(168,85,247,.2);
}

button{
    width:100%;
    border:none;
    padding:15px;
    border-radius:14px;
    background:linear-gradient(135deg,#7E22CE,#A855F7);
    color:white;
    font-size:1rem;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:linear-gradient(135deg,#6B21A8,#9333EA);
    transform:translateY(-2px);
}

.links a{
    color:#C084FC;
    text-decoration:none;
    font-size:.9rem;
}

.links a:hover{
    text-decoration:underline;
}

.quote{
    text-align:center;
    margin-top:25px;
    color:#A1A1AA;
    font-size:.85rem;
    font-style:italic;
}
</style>
</head>
<body>

<div class="book"></div>
<div class="book"></div>

<div class="login-container">

    <div class="logo">📚</div>

    <h1>Bem-vindo</h1>
    <p class="subtitle">Entrar</p>

    <form action="../controle/processarEntrar.php" method="post">
        <div class="input-group">
            <label>Email</label>
            <input type="email" placeholder="seu@email.com" name="email" required>
        </div>

        <div class="input-group">
            <label>Senha</label>
            <input type="password" placeholder="••••••••" name="senha" required>
        </div>

        <button type="submit" name="submit">
            Entrar
        </button>
    </form>

    <div class="links">
        <a href="paginaCadastrar.php">Não possui uma conta?</a>
    </div>

    <div class="quote">
        "Um leitor vive mil vidas antes de morrer."
    </div>

</div>

</body>
</html>