<?php

namespace Source\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of ItemProduto
 *
 * @author Reginaldo
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="item_produtos")
 */
class ItemProduto
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne
     */
    private Produto $produto;

    /**
     * @ORM\ManyToOne(targetEntity="Entrada", inversedBy="listaItemProdutos")
     * @ORM\JoinColumn(name="entrada_id", referencedColumnName="id")
     */
    private Entrada $entrada;

    /**
     * @ORM\Column(type="decimal", scale=3)
     */
    private float $quantidade;

    /**
     * @ORM\Column(name="valor_unitario", type="decimal", scale=2)
     */
    private float $valorUnitario;

    /**
     * @ORM\Column(name="valor_total", type="decimal", scale=2)
     */
    private float $valorTotal;

    public function __construct()
    {
        // $this->entrada = new Entrada();
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function getEntrada(): Entrada
    {
        return $this->entrada;
    }

    public function getQuantidade(): float
    {
        return $this->quantidade;
    }

    public function setProduto(Produto $produto): void
    {
        $this->produto = $produto;
    }

    public function setEntrada(?Entrada $entrada): void
    {
        $this->entrada = $entrada;
    }

    public function setQuantidade(float $quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    public function getValorUnitario(): float
    {
        return $this->valorUnitario;
    }

    public function setValorUnitario(float $valorUnitario): void
    {
        $this->valorUnitario = $valorUnitario;
    }

    public function getValorTotal(): float
    {
        return $this->valorTotal;
    }

    public function setValorTotal(float $valorTotal): void
    {
        $this->valorTotal = $valorTotal;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
