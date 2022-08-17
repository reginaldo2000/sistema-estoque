<?php

namespace Source\DAO;

use Exception;
use Doctrine\Common\Collections\ArrayCollection;
use Source\Entity\EntityManagerFactory;
use Source\Entity\Usuario;

class UsuarioDAO 
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
            $usuarioRepo = EntityManagerFactory::getEntityManager()->getRepository(Usuario::class)
                ->createQueryBuilder('u');

            $listaUsuarios = $usuarioRepo->where($usuarioRepo->expr()->like("u.nomeUsuario", ":nomeUsuario"))
                ->setParameter("nomeUsuario", '%' . $nomeUsuario . '%')
                ->getQuery()
                ->getResult();
            return $listaUsuarios;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * @param Usuario $usuario
     * @return void
     */
    public static function salvar(Usuario $usuario): void {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($usuario);
            $em->flush();
        } catch(Exception $e) {
            throw new Exception("Erro durante tentativa de salvar um novo usuário! {$e->getMessage()}", 500);
        }
    }
}
