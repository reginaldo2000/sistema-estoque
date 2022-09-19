<?php

namespace Source\DAO;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Produto;
use Source\Utils\Paginacao;

class ProdutoDAO extends GenericDAO
{

    public function __construct()
    {
    }

    public static function listarProdutos(string $nome = ""): ?array
    {
        try {
            $queryBuilder = EntityManagerFactory::getEntityManager()->getRepository(Produto::class)
                ->createQueryBuilder("p");

            $query = $queryBuilder->where("p.nome LIKE :nome AND p.status != :status")
                ->setParameter("nome", '%' . $nome . '%')
                ->setParameter("status", "EXCLUIDO")
                ->orderBy("p.nome")->getQuery();

            return $query->getResult();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function listarProdutosByIds(string $ids): ?array
    {
        try {
            $queryBuilder = EntityManagerFactory::getEntityManager()->getRepository(Produto::class)
                ->createQueryBuilder("p");

            $query = $queryBuilder->where("p.id NOT IN(" . $ids . ") AND p.status != :status")
                ->setParameter("status", "EXCLUIDO")
                ->orderBy("p.nome")->getQuery();

            return $query->getResult();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function salvar(Produto $produto): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($produto);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function get(int $id): ?Produto
    {
        try {
            return EntityManagerFactory::getEntityManager()->find(Produto::class, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function getByCodigo(string $codigoProduto): ?Produto
    {
        try {
            return EntityManagerFactory::getEntityManager()->getRepository(Produto::class)
                ->findOneBy(["codigoProduto" => $codigoProduto]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function atualizar(Produto $produto, int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $produtoObject = $em->find(Produto::class, $id);
            $produtoObject = $produto;
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar o produto! - {$e->getMessage()}", 500);
        }
    }

    public static function excluir(int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $produto = $em->find(Produto::class, $id);
            if (empty($produto)) {
                throw new Exception("Produto inexistente!");
            }
            $produto->setStatus("EXCLUIDO");
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
