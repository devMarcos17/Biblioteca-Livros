<?php
namespace Marcos\Modelo;

use PDO;

class Livro
{
    public ?int $id;
    public function __construct(
        public readonly string $nome,
        private string $genero,
        private string $autor,
        private int $preco,
        private string $caminhoImagem,
        private string $descricao,
        private string $nome_arquivo,
        private string $url_arquivo,
        ?int $id = null
        )
    {
        $this->id = $id;
        
    }

    public function getGenero(): string
    {
        return $this->genero;
    }
    public function getAutor(): string
    {
        return $this->autor;
    }
    public function getPreco(): int
    {
        return $this->preco;
    }
    public function getCaminhoImagem(): string
    {
        return $this->caminhoImagem;
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function getNomeArquivo(): string
    {
        return $this->nome_arquivo;
    }
    public function getUrlArquivo(): string
    {
        return $this->url_arquivo;
    }
}
?>