<?php

include_once 'Conectar.php';

class Passageiro
{

    private $id;
    private $nome;
    private $data_nascimento;
    private $con;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO passageiro (nome, data_nascimento) VALUES (?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->nome);
            $executar->bindValue(2, $this->data_nascimento);
            return $executar->execute() ? "Cadastrado" : "Erro ao cadastrar";
        } catch (PDOException $e) {
            return "Erro de bd " . $e->getMessage();
        }
    }

    public function listar()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM passageiro";
            $executar = $this->con->prepare($sql);
            $executar->execute();
            return $executar->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erro de bd " . $e->getMessage();
        }
    }

    public function crud($opcao)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_passageiro(?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->nome);
            $executar->bindValue(3, $this->data_nascimento);
            $executar->bindValue(4, $opcao);
            return $executar->execute() ? "Operação realizada com sucesso" : "Erro ao executar operação";
        } catch (PDOException $e) {
            return "Erro de bd " . $e->getMessage();
        }
    }
}
