<?php

namespace Source\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Entrada
 *
 * @author Reginaldo
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="entradas")
 */
class Entrada {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $descricao;

    /**
     * @ORM\Column(name="codigo_nota", type="string", length=100)
     */
    private string $codigoNota = "";

    /**
     * @ORM\Column(name="valor_total", type="decimal", scale=2)
     */
    private float $valorTotal = 0.0;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $status = "EM_EDICAO";

    /**
     * @ORM\Column(name="data_criacao", type="datetime")
     */
    private DateTime $dataCriacao;

    /**
     * @ORM\Column(name="data_modificacao", type="datetime")
     */
    private DateTime $dataModificacao;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id")
     */
    private Usuario $usuario;

    /**
     * @ORM\OneToMany(targetEntity="ItemProduto", mappedBy="entrada") 
     */
    private ArrayCollection $listaItemProdutos;

    public function __construct() {
        $this->listaItemProdutos = new ArrayCollection();
        $this->dataCriacao = new DateTime();
        $this->dataModificacao = new DateTime();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getCodigoNota(): string {
        return $this->codigoNota;
    }

    public function getValorTotal(): float {
        return $this->valorTotal;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDataCriacao(): DateTime {
        return $this->dataCriacao;
    }

    public function getDataModificacao(): DateTime {
        return $this->dataModificacao;
    }

    public function getUsuario(): Usuario {
        return $this->usuario;
    }

    public function getListaItemProdutos(): ArrayCollection {
        return $this->listaItemProdutos;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function setCodigoNota(string $codigoNota): void {
        $this->codigoNota = $codigoNota;
    }

    public function setValorTotal(float $valorTotal): void {
        $this->valorTotal = $valorTotal;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setDataCriacao(DateTime $dataCriacao): void {
        $this->dataCriacao = $dataCriacao;
    }

    public function setDataModificacao(DateTime $dataModificacao): void {
        $this->dataModificacao = $dataModificacao;
    }

    public function setUsuario(Usuario $usuario): void {
        $this->usuario = $usuario;
    }

    public function setListaItemProdutos(ArrayCollection $listaItemProdutos): void {
        $this->listaItemProdutos = $listaItemProdutos;
    }

}
