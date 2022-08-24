<?php

namespace Source\DAO;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Source\Entity\EntityManagerFactory;

class BootDAO
{

    public function __construct()
    {
    }

    public static function criarUnidadesDeMedida(ArrayCollection $listaUnidadesMedida): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            foreach ($listaUnidadesMedida as $unidade) {
                $em->persist($unidade);
            }
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro na unidade de medida!", 500);
        }
    }
}
