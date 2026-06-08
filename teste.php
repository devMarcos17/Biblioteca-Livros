<?php
require_once __DIR__ . "/config/config.php";


$conexao->exec("CREATE UNIQUE INDEX IF NOT EXISTS usuario_livro_unico ON favoritos (id_usuario, id_livro);");
?>