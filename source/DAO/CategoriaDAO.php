<?php

namespace Source\DAO;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Source\Entity\Categoria;
use Source\Entity\EntityManagerFactory;
use Source\Utils\Paginacao;

class CategoriaDAO extends GenericDAO
{

    public function __construct()
    {
    }

    /**
     * retorna uma lista de objetos de Categoria
     * @param string $nome
     * @param Paginacao|null $paginacao
     */
    public static function listar(string $nome = "", Paginacao $paginacao = null): array
    {
        $queryBuilder = EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)->createQueryBuilder("c");

        $query = $queryBuilder->where("c.nome LIKE :nome AND c.status != :status")
            ->setParameter("nome", '%' . $nome . '%')
            ->setParameter("status", 'EXCLUIDO')
            ->orderBy("c.nome")->getQuery();

        $paginator = new Paginator($query);
        self::setMaxRow(count($paginator));

        if ($paginacao != null) {
            $inicio = ($paginacao->getPagina() - 1) * $paginacao->getNumeroLinhas();
            $query->setFirstResult($inicio)->setMaxResults($paginacao->getNumeroLinhas());
        }

        return $query->getResult();
    }

    /**
     * Retorna um objeto de Categoria
     * @param int $id
     * @return Categoria|null
     */
    public static function get(int $id): ?Categoria
    {
        return EntityManagerFactory::getEntityManager()
            ->getRepository(Categoria::class)
            ->find($id);
    }

    /**
     * salva uma Categoria na base de dados
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

    /**
     * atualiza os dados da Categoria na base de dados
     * @param Categoria $categoria
     * @param int $id
     * @return void
     */
    public static function atualizar(Categoria $categoria, int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $categoriaObj = $em->find(Categoria::class, $id);
            $categoriaObj->setNome($categoria->getNome());
            $em->flush();
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar a categoria!", 500);
        }
    }

    public static function excluir(int $id): void
    {
        try {
            $em = EntityManagerFactory::getEntityManager();
            $categoriaObj = $em->find(Categoria::class, $id);

            if (empty($categoriaObj)) {
                throw new Exception("Id da categoria está inválido!");
            }
            $categoriaObj->setStatus("EXCLUIDO");
            $em->flush();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
