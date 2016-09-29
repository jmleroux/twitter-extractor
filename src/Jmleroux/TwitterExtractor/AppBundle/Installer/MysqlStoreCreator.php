<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Installer;

use Doctrine\DBAL\Connection;
use Jmleroux\TwitterExtractor\AppBundle\Installer\Db\Mysql;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MysqlStoreCreator implements StoreCreatorInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createStore()
    {
        $tweetsTable = $this->container->getParameter('twitter.table');

        /** @var Connection $dbal */
        $dbal = $this->container->get('doctrine.dbal.default_connection');
        $dbCreator = new Mysql($dbal);
        $createSql = $dbCreator->getCreateSql($tweetsTable);
        $dbal->executeQuery($createSql);
    }
}
