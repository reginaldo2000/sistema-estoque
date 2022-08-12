<?php

namespace Source\DAO;

use Exception;
use Doctrine\Common\Collections\ArrayCollection;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Usuario;

class UsuarioDAO extends EntityManagerFactory
{

    public function __construct()
    {
    }

    public static function getUsuario(string $usuario, string $senha): ?Usuario
    {
        try {
            return EntityManagerFactory::getEntityManager()->getRepository(Usuario::class)
                ->findOneBy(["usuario" => $usuario, "senha" => $senha]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    public static function listaUsuarios(?string $nomeUsuario): ?array
    {
        try {
            $listaUsuarios = EntityManagerFactory::getEntityManager()
                ->createQuery("SELECT u FROM Source\Entity\Usuario u WHERE u.nomeUsuario LIKE ?1")
                ->setParameter(1, "'%$nomeUsuario%'")
                ->getResult();
            return $listaUsuarios;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
