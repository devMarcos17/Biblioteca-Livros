<?php
namespace Marcos\Modelo;

class Usuario
{
    public ?int $id;
    public function __construct(public readonly string $nome, private string $email, private string $senha, private string $role = "user", ?int $id = null)
    {
        $this->id = $id;
        
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function getRole(): string
    {
        return $this->senha;
    }
}
?>