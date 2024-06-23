<?php

include_once 'Conectar.php';

class Viagem
{

    private $id;
    private $id_onibus;
    private $id_passageiro;
    private $data_viagem;
    private $con;

    public function getId()
    {
        return $this->id;
    }

    public function getIdOnibus()
    {
        return $this->id_onibus;
    }

    public function getIdPassageiro()
    {
        return $this->id_passageiro;
    }

    public function getDataViagem()
    {
        return $this->data_viagem;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdOnibus($id_onibus): void
    {
        $this->id_onibus = $id_onibus;
    }

    public function setIdPassageiro($id_passageiro): void
    {
        $this->id_passageiro = $id_passageiro;
    }

    public function setDataViagem($data_viagem): void
    {
        $this->data_viagem = $data_viagem;
    }

    public function salvar()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO viagem (id_onibus, id_passageiro, data_viagem) VALUES (?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id_onibus);
            $executar->bindValue(2, $this->id_passageiro);
            $executar->bindValue(3, $this->data_viagem);
            return $executar->execute() ? "Cadastrado" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }

    public function listar($id = NULL)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT v.id, v.id_onibus, v.id_passageiro, v.data_viagem, o.modelo AS onibus_nome, p.nome AS passageiro_nome
                    FROM viagem v
                    JOIN onibus o ON v.id_onibus = o.id
                    JOIN passageiro p ON v.id_passageiro = p.id";

            if ($id !== NULL) {
                $sql .= " WHERE v.id = :id";
            }

            $stmt = $this->con->prepare($sql);

            if ($id !== NULL) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }


    public function crud($opcao)
    {
        try {
            $this->con = new Conectar();
            $sql = "CALL crud_viagem(?, ?, ?, ?)";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id_onibus);
            $executar->bindValue(2, $this->id_passageiro);
            $executar->bindValue(3, $this->data_viagem);
            $executar->bindValue(4, $opcao);
            return $executar->execute() ? "Procedimento ok" : "Erro";
        } catch (PDOException $e) {
            echo "Erro de bd " . $e->getMessage();
        }
    }
}
