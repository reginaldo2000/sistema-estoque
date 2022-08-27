<?php

namespace Source\DAO;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Source\Entity\Categoria;
use Source\Entity\EntityManagerFactory;
use Source\Utils\Paginacao;

class CategoriaDAO
{

    public function __construct()
    {
    }

    public static function listar(string $nome = "", Paginacao $paginacao = null): array
    {
        $queryBuilder = EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)->createQueryBuilder("c");

        $query = $queryBuilder->where("c.nome LIKE :nome")
            ->setParameter("nome", '%' . $nome . '%')
            ->orderBy("c.id")->getQuery();

        $paginator = new Paginator($query);

        if($paginacao != null) {
            $inicio = ($paginacao->getPagina() - 1) * $paginacao->getNumeroLinhas();
            $query->setFirstResult($inicio)->setMaxResults($paginacao->getNumeroLinhas());
        }

        // var_dump($query->getResult());
        // exit;
        
        return $query->getResult();
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
