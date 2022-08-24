<?php

namespace Source\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

/**
 * Description of EntityManagerFactory
 *
 * @author Reginaldo
 */
class EntityManagerFactory {

    private static $isDevMode = true;
    private static $proxyDir = null;
    private static $cache = null;
    private static $useSimpleAnnotationReader = false;
    private static $instance = null;

    public static function getEntityManager(): EntityManagerInterface {
        $config = ORMSetup::createAnnotationMetadataConfiguration(
                        array(__DIR__ . "/../../source"),
                        self::$isDevMode,
                        self::$proxyDir,
                        self::$cache,
                        self::$useSimpleAnnotationReader
        );
        $conn = array(
            "url" => "mysql://root:@localhost/sistema_estoque"
        );
        if (self::$instance == null) {
            self::$instance = EntityManager::create($conn, $config);
        }
        return self::$instance;
    }

}
