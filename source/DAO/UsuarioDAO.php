<?php

namespace Source\DAO;

use Exception;
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
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
