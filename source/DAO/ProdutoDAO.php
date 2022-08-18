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
            throw new Exception("Erro ao cadastrar o produto! ".$e->getMessage(), 500);
        }
    }
}
