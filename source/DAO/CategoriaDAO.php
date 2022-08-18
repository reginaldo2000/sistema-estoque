<?php

namespace Source\DAO;

use Source\Entity\Categoria;
use Source\Entity\EntityManagerFactory;

class CategoriaDAO
{

    public function __construct()
    {
    }

    public static function listar(): array
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)
            ->findAll();
    }

    public static function get(int $id): ?Categoria
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)
            ->find($id);
    }
}
