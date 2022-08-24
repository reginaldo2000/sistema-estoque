<?php

namespace Source\DAO;

use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Produto;

class ProdutoDAO
{

    public function __construct()
    {
    }

    public static function listarProdutos(string $nome): ?array
    {
        try {
            $queryBuilder = EntityManagerFactory::getEntityManager()->getRepository(Produto::class)
                ->createQueryBuilder("p");

            return $queryBuilder->where("p.nome LIKE :nome")->setParameter("nome", '%' . $nome . '%')
                ->orderBy("p.nome")->getQuery()->getResult();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function salvar(Produto $produto): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($produto);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao cadastrar o produto! " . $e->getMessage(), 500);
        }
    }

    public static function get(int $id): ?Produto
    {
        try {
            return EntityManagerFactory::getEntityManager()->find(Produto::class, $id);
        } catch (Exception $e) {
            throw new Exception("Erro ao cadastrar o produto! " . $e->getMessage(), 500);
        }
    }

    public static function atualizar(Produto $produto): void {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $produtoObject = $em->find(Produto::class, $produto->getId());

            $produtoObject->setNome($produto->getNome());
            $produtoObject->setCodigoProduto($produto->getCodigoProduto());
            $produtoObject->setCodigoBarras($produto->getCodigoBarras());
            $produtoObject->setEstoque($produto->getEstoque());
            $produtoObject->setPrecoEntrada($produto->getPrecoEntrada());
            $produtoObject->setPrecoSaida($produto->getPrecoSaida());
            $produtoObject->setCategoria($produto->getCategoria());
            $produtoObject->setUnidadeMedida($produto->getUnidadeMedida());
            $produtoObject->setDataModificacao($produto->getDataModificacao());
            $em->flush();
        } catch(Exception $e) {
            setMessage("Erro ao atualizar!", "alert-danger");
            redirect("/produto/editar/{$produto->getId()}");
        }
    }
}
