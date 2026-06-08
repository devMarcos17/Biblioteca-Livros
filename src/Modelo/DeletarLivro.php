<?php
namespace Marcos\Modelo;

use PDO;

class DeletarLivro
{
    private PDO $conexao;
    public function __construct(
        PDO $conexao
    )
    {
        $this->conexao = $conexao;
    }

    public function deletarLivro(Livro $livro): bool
    {
        $id = $livro->id;

        $query = "DELETE FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute([$id]);
        
        if($stmt->rowCount() <=0){
            return false;
        }
        return true;

    }

    public function deletarLivroFavorito(int $idUsuario, int $idLivro): bool
    {
        $query = "DELETE FROM favoritos WHERE id_usuario = ? AND id_livro = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idLivro, PDO::PARAM_INT);
        
        $sucesso = $stmt->execute([$idUsuario, $idLivro]);
        if($sucesso){
            return true;
        }
        return false;

    }
}
?>