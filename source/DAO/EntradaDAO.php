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

    public static function salvar(Entrada $entrada): void {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($entrada);
            $em->flush();
        } catch(Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
