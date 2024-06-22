<?php

include_once 'Conectar.php';

class Produto
{

    private $id;
    private $nome;
    private $estoque;
    private $valor_unit;
    private $id_categoria;
    private $con;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEstoque()
    {
        return $this->estoque;
    }

    public function getValor_unit()
    {
        return $this->valor_unit;
    }

    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function setEstoque($estoque): void
    {
        $this->estoque = $estoque;
    }

    public function setValor_unit($valor_unit): void
    {
        $this->valor_unit = $valor_unit;
    }

    public function setId_categoria($id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }

    public function listar($id)
    {
        try {
            $this->con = new Conectar();
            //$sql = "CALL listar_categoria (?)";
            $sql = "SELECT * FROM view_produto;";
            $executar = $this->con->prepare($sql);
            //$executar->bindValue(1, $id);
            return $executar->execute() == 1 ? $executar->fetchAll() : false;
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    public function crud($opcao)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_produto(?, ?, ?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->nome);
            $executar->bindValue(3, $this->estoque);
            $executar->bindValue(4, $this->valor_unit);
            $executar->bindValue(5, $this->id_categoria);
            $executar->bindValue(6, $opcao);
            return $executar->execute() == 1 ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    //fim do crud
}

//fim da class
