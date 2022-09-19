<?php

namespace Source\DAO;

use ArrayObject;
use Exception;
use Source\Entity\EntityManagerFactory;
use Source\Entity\ItemProduto;
use Source\Exception\InternalErrorException;

class ItemEntradaDAO extends GenericDAO
{

    public function __construct()
    {
    }

    public static function salvar(ItemProduto $item): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($item);
            $em->flush();
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage(), 500);
        }
    }

    public static function excluir(int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $item = $em->getRepository(ItemProduto::class)->find($id);
            $em->remove($item);
            $em->flush();
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage(), 500);
        }
    }

    public static function atualizar(ItemProduto $item, int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $novoItem = $em->getRepository(ItemProduto::class)->find($id);
            $novoItem = $item;
            $em->flush();
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage(), 500);
        }
    }

    public static function listarItensEntradaTemp(string $key): ArrayObject
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            return new ArrayObject($em->getRepository(ItemProduto::class)->findBy(["chave" => $key]));
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage(), 500);
        }
    }
}
