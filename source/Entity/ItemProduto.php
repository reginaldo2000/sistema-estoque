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
class ItemProduto {

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
     * @ORM\ManyToOne
     */
    private Entrada $entrada;
    
    /**
     * @ORM\Column(type="decimal", scale=3)
     */
    private float $quantidade;

    public function __construct() {
        
    }

    public function getProduto(): Produto {
        return $this->produto;
    }

    public function getEntrada(): Entrada {
        return $this->entrada;
    }

    public function getQuantidade(): float {
        return $this->quantidade;
    }

    public function setProduto(Produto $produto): void {
        $this->produto = $produto;
    }

    public function setEntrada(Entrada $entrada): void {
        $this->entrada = $entrada;
    }

    public function setQuantidade(float $quantidade): void {
        $this->quantidade = $quantidade;
    }

}
