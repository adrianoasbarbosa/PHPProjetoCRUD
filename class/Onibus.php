<?php

include_once 'Conectar.php';

class Onibus
{

    private $id;
    private $modelo;
    private $lugares;
    private $destino;
    private $con;

    public function getId()
    {
        return $this->id;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getLugares()
    {
        return $this->lugares;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setLugares($lugares)
    {
        $this->lugares = $lugares;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO onibus VALUES (?, ?, ?, ?);";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->modelo);
            $executar->bindValue(3, $this->lugares);
            $executar->bindValue(4, $this->destino);
            return $executar->execute() ? "Cadastrado" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    public function listar()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM onibus";
            $executar = $this->con->prepare($sql);
            $executar->execute();
            return $executar->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    public function crud($opcao)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_onibus(?, ?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id);
            $executar->bindValue(2, $this->modelo);
            $executar->bindValue(3, $this->lugares);
            $executar->bindValue(4, $this->destino);
            $executar->bindValue(5, $opcao);
            return $executar->execute() ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }
}
