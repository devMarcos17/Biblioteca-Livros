<?php
namespace Marcos\Modelo;

use PDO;

class ListarLivro
{
    private PDO $conexao;
    public function __construct(PDO $conexao)
    {
     $this->conexao = $conexao;
    }
    public function listarLivro($genero = null): array
    {
        
    if ($genero !== null) {
        $query = "SELECT id, nome, genero, autor, preco, imagem, descricao FROM livros WHERE genero = :genero ORDER BY nome ASC";
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':genero', $genero);
    } else {
        $query = "SELECT id, nome, genero, autor, preco, imagem FROM livros";
        $stmt = $this->conexao->prepare($query);
    }

    $stmt->execute();
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $livros; 
    }


    public function buscarLivro(string $nome): array
    {
         $nome = "%" . $nome . "%";

        $query = "SELECT id, nome, genero, autor, preco, imagem
              FROM livros 
              WHERE nome LIKE ? 
                 OR genero LIKE ? 
                 OR autor LIKE ? 
                 OR id LIKE ?";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $nome);
        $stmt->bindParam(3, $nome);
        $stmt->bindParam(4, $nome);
        $suceso = $stmt->execute();
        $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $livros;
    }
    public function listarLivroID($id)
    {
        $query = "SELECT * FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $sucesso = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$sucesso){
            die("Livro não encotrado");
        }
        return $sucesso;
        

    }
}


?>