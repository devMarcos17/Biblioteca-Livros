<?php

namespace Marcos\Modelo;

use PDO;

class AtualizarLivro
{
    private PDO $conexao;
    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function atualizarLivro(Livro $livro): bool
    {
        $id = $livro->id;
        $nome = $livro->nome;
        $genero = $livro->getGenero();
        $autor = $livro->getAutor();
        $preco = $livro->getPreco();
        $caminhoImagem = $livro->getCaminhoImagem();
        $nomeArquivo = $livro->getNomeArquivo();
        $urlArquivo = $livro->getUrlArquivo();

        $query = "UPDATE livros SET nome = ?, genero = ?, autor = ?, preco = ?, imagem = ?, nome_arquivo = ?, url_arquivo = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $genero);
        $stmt->bindParam(3, $autor);
        $stmt->bindParam(4, $preco);
        $stmt->bindParam(5, $caminhoImagem);
        $stmt->bindParam(6, $nomeArquivo);
        $stmt->bindParam(7, $urlArquivo);
        $stmt->bindParam(8, $id);
        $stmt->execute();

        if($stmt->execute()){
            return true;
        }
        
        return false;
    }
}
