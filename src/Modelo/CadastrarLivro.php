<?php
namespace Marcos\Modelo;

use PDO;

class CadastrarLivro
{
    private PDO $conexao;
    public function __construct(PDO $conexao)
    {
     $this->conexao = $conexao;
    }
    public function cadastrarLivro(Livro $livro): bool
    {
        $nome = $livro->nome;
        $genero = $livro->getGenero();
        $autor = $livro->getAutor();
        $preco = $livro->getPreco();
        $imagem = $livro->getCaminhoImagem();
        $descricao = $livro->getDescricao();
        $nome_arquivo = $livro->getNomeArquivo();
        $url_arquivo = $livro->getUrlArquivo();

        $query = "INSERT INTO livros (nome, genero, autor, preco, imagem, descricao, nome_arquivo, url_arquivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $genero);
        $stmt->bindParam(3, $autor);
        $stmt->bindParam(4, $preco);
        $stmt->bindParam(5, $imagem);
        $stmt->bindParam(6, $descricao);
        $stmt->bindParam(7, $nome_arquivo);
        $stmt->bindParam(8, $url_arquivo);

        $ucesso = $stmt->execute();
        if($ucesso){
            return true;
        }
        return false;
    }
}
?>