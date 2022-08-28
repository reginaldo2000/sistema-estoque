<?php

namespace Source\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categorias")
 */
class Categoria
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $nome;

    /**
     * @ORM\Column(type="string", length=20, options={"default":"ATIVO"})
     */
    private string $status = "ATIVO";

    /**
     * @ORM\Column(name="data_criacao", type="datetime")
     */
    private DateTime $dataCriacao;

    /**
     * @ORM\Column(name="data_modificacao", type="datetime")
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

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function toArray(): array
    {
        $dados = [
            "id" => $this->id,
            "nome" => $this->nome,
            "status" => $this->status
        ];
        return $dados;
    }
}
