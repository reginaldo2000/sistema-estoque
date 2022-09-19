<?php

namespace Source\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Annotations\Annotation\Enum;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 */
class Usuario
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $usuario;

    /**
     * @ORM\Column(type="string")
     */
    private string $senha;

    /**
     * @ORM\Column(type="string", name="nome_usuario")
     */
    private string $nomeUsuario;

    /**
     * @ORM\Column(type="string", options={"default":"ATIVO"})
     */
    private string $status = "ATIVO";

    /**
     * @ORM\Column(type="datetime", name="data_criacao")
     */
    private DateTime $dataCriacao;

    /**
     * @ORM\Column(type="datetime", name="data_modificacao")
     */
    private DateTime $dataModificacao;

    public function __construct()
    {
        $this->dataCriacao = new DateTime();
        $this->dataModificacao = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function getNomeUsuario(): string
    {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario(string $nomeUsuario): void
    {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getDataCriacao(): DateTime
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(DateTime $dataCriacao): void
    {
        $this->dataCriacao = $dataCriacao;
    }

    public function getDataModificacao(): DateTime
    {
        return $this->dataModificacao;
    }

    public function setDataModificacao(DateTime $dataModificacao): void
    {
        $this->dataModificacao = $dataModificacao;
    }

    public function toArray(): array
    {
        $array = [
            "id" => $this->id,
            "usuario" => $this->usuario,
            "senha" => $this->senha,
            "nomeUsuario" => $this->nomeUsuario,
            "status" => $this->status,
            "dataCriacao" => $this->dataCriacao,
            "dataModificacao" => $this->dataModificacao
        ];
        return $array;
    }
}
