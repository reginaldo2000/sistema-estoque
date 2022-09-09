<?php

namespace Source\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="produtos")
 */
class Produto
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
     * @ORM\Column(name="codigo_produto", type="string")
     */
    private string $codigoProduto = "";

    /**
     * @ORM\Column(name="codigo_barras", type="string")
     */
    private string $codigoBarras = "";

    /**
     * @ORM\Column(name="preco_entrada", type="decimal", scale=2)
     */
    private float $precoEntrada = 0.0;

    /**
     * @ORM\Column(name="preco_saida", type="decimal", scale=2)
     */
    private float $precoSaida = 0.0;

    /**
     * @ORM\Column(type="decimal", scale=3)
     */
    private float $estoque;

    /**
     * @ORM\Column(options={"default" : "ATIVO"}, length=10) 
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

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", fetch="EAGER")
     */
    private Categoria $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="UnidadeMedida", fetch="EAGER")
     * @ORM\JoinColumn(name="unidade_medida_id", referencedColumnName="id")
     */
    private UnidadeMedida $unidadeMedida;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", fetch="EAGER")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private Usuario $usuario;

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

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getUnidadeMedida(): UnidadeMedida
    {
        return $this->unidadeMedida;
    }

    public function setUnidadeMedida(UnidadeMedida $unidadeMedida): void
    {
        $this->unidadeMedida = $unidadeMedida;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getCodigoProduto(): string
    {
        return $this->codigoProduto;
    }

    public function setCodigoProduto(string $codigoProduto): void
    {
        $this->codigoProduto = $codigoProduto;
    }

    public function getCodigoBarras(): string
    {
        return $this->codigoBarras;
    }

    public function setCodigoBarras(string $codigoBarras): void
    {
        $this->codigoBarras = $codigoBarras;
    }

    public function getPrecoEntrada(): float
    {
        return $this->precoEntrada;
    }

    public function setPrecoEntrada(float $precoEntrada): void
    {
        $this->precoEntrada = $precoEntrada;
    }

    public function getPrecoSaida(): float
    {
        return $this->precoSaida;
    }

    public function setPrecoSaida(float $precoSaida): void
    {
        $this->precoSaida = $precoSaida;
    }

    public function getEstoque(): float
    {
        return $this->estoque;
    }

    public function setEstoque(float $estoque): void
    {
        $this->estoque = $estoque;
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

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function toArray(): array
    {
        $dados = [
            "id" => $this->id,
            "nome" => $this->nome,
            "categoria" => [
                "id" => $this->categoria->getId(),
                "nome" => $this->categoria->getNome()
            ]
        ];
        return $dados;
    }
}
