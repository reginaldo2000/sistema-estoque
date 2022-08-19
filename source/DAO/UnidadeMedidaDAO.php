<?php

namespace Source\DAO;

use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\UnidadeMedida;

class UnidadeMedidaDAO
{

    public function __construct()
    {
    }

    public static function listar(): array
    {
        try {
            return EntityManagerFactory::getEntityManager()
                ->getRepository(UnidadeMedida::class)
                ->findAll();
        } catch (Exception $e) {
            throw new Exception("Lista vazia", 500);
        }
    }

    public static function get(int $id): ?UnidadeMedida
    {
        try {
            return EntityManagerFactory::getEntityManager()
                ->find(UnidadeMedida::class, $id);
        } catch (Exception $e) {
            throw new Exception("Lista vazia", 500);
        }
    }
}
