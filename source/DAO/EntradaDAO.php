<?php

namespace Source\DAO;

use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Entrada;

class EntradaDAO extends GenericDAO
{

    private function __construct()
    {
    }

    public static function salvar(Entrada $entrada): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($entrada);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function atualizar(Entrada $entrada): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $entradaObj = $em->getRepository(Entrada::class)->find($entrada->getId());
            $entradaObj = $entrada;
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function listar(string $descricao = ""): ?array
    {
        try {
            $em = EntityManagerFactory::getEntityManager();

            $query = $em->getRepository(Entrada::class)
                ->createQueryBuilder("e")
                ->where("e.descricao LIKE :descricao")
                ->setParameter("descricao", '%' . $descricao . '%')
                ->orderBy("e.dataCriacao")->orderBy("e.descricao")
                ->getQuery();
            return $query->getResult();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function get(int $id): ?Entrada
    {
        try {
            return EntityManagerFactory::getEntityManager()->find(Entrada::class, $id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
