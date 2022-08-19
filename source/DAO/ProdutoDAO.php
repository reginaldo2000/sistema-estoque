<?php

namespace Source\DAO;

use Doctrine\ORM\EntityManager;
use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Produto;

class ProdutoDAO
{

    public function __construct()
    {
    }

    public static function listarProdutos(): array
    {
        return [];
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
}
