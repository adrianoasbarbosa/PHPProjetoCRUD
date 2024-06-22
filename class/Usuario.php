<?php

include_once 'Conectar.php';

class Usuario
{
    private $email;
    private $senha;
    private $con;

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    public function cadastrar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO usuario (email, senha) VALUES (?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(1, $this->email);
            $stmt->bindValue(2, sha1($this->senha));
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function login()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(1, $this->email);
            $stmt->bindValue(2, sha1($this->senha));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
