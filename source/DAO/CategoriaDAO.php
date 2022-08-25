<?php

namespace Source\DAO;

use Exception;
use Source\Entity\Categoria;
use Source\Entity\EntityManagerFactory;

class CategoriaDAO
{

    public function __construct()
    {
    }

    public static function listar(string $nome = ""): array
    {
        $queryBuilder = EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)->createQueryBuilder("c");

        return $queryBuilder->where("c.nome LIKE :nome")
            ->setParameter("nome", '%' . $nome . '%')
            ->orderBy("c.nome")->getQuery()->getResult();
    }

    public static function get(int $id): ?Categoria
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)
            ->find($id);
    }

    /**
     * @param Categoria $categoria
     * @return void
     */
    public static function salvar(Categoria $categoria): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($categoria);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao cadastrar a categoria!", 500);
        }
    }
}
