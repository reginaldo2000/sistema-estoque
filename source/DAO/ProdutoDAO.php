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

    public static function listarProdutos(string $nome = "", Paginacao $paginacao = null): ?array
    {
        try {
            $queryBuilder = EntityManagerFactory::getEntityManager()->getRepository(Produto::class)
                ->createQueryBuilder("p");

            $query = $queryBuilder->where("p.nome LIKE :nome AND p.status != :status")
                ->setParameter("nome", '%' . $nome . '%')
                ->setParameter("status", "EXCLUIDO")
                ->orderBy("p.nome")->getQuery();

            if ($paginacao != null) {
                $paginator = new Paginator($query);
                self::setMaxRow(count($paginator));

                $inicio = ($paginacao->getPagina() - 1) * $paginacao->getNumeroLinhas();
                $query->setFirstResult($inicio)->setMaxResults($paginacao->getNumeroLinhas());
            }
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

    public static function atualizar(Produto $produto): void
    {
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
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar o produto!", 500);
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
