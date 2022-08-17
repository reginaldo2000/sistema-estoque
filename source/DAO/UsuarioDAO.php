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

    /**
     * @param string $usuario
     * @param string $senha
     * @return Usuario|null
     */
    public static function getUsuario(string $usuario, string $senha): ?Usuario
    {
        try {
            return EntityManagerFactory::getEntityManager()->getRepository(Usuario::class)
                ->findOneBy(["usuario" => $usuario, "senha" => $senha]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * @param string|null $nomeUsuario
     * @return array|null
     */
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
    public static function salvar(Usuario $usuario): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $em->persist($usuario);
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro durante tentativa de salvar um novo usuário! {$e->getMessage()}", 500);
        }
    }

    /**
     * @param Usuario $usuario
     */
    public static function atualizar(Usuario $usuario): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $usuarioObject = $em->getRepository(Usuario::class)->find($usuario->getId());
            $usuarioObject->setUsuario($usuario->getUsuario());
            $usuarioObject->setNomeUsuario($usuario->getNomeUsuario());
            $usuarioObject->setStatus($usuario->getStatus());
            $usuarioObject->setDataModificacao($usuario->getDataModificacao());
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }

    /**
     * @param int $id
     * @return Usuario|null
     */
    public static function getUsuarioById(int $id): ?Usuario
    {
        try {
            return EntityManagerFactory::getEntityManager()
                ->find(Usuario::class, $id);
        } catch (Exception $e) {
            throw new Exception("Usuário não encontrado! {$e->getMessage()}", 500);
        }
    }
}
