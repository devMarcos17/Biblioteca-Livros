<?php
namespace Marcos\Modelo;

use PDO;

class BaixarArquivoPdf
{
    private PDO $conexao;
    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function baixarPDF(string $pdf)
    {
        $query = "SELECT nome_arquivo, url_arquivo FROM livros WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $pdf);
        $stmt->execute();
        $livros = $stmt->fetch(PDO::FETCH_ASSOC);

        if($livros){
            return $livros;
        }
        return null;
    }
}
?>