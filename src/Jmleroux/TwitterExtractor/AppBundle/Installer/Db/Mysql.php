<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Installer\Db;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;

class Mysql
{
    /**
     * @var Connection
     */
    private $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * Creates the tweet store table.
     *
     * @param int $tablename
     *
     * @return string
     */
    public function getCreateSql($tablename)
    {
        $schema = new Schema();

        $table = $schema->createTable($tablename);
        $table->addColumn('id', 'string', ['length' => 50]);
        $table->addColumn('content', 'text');
        $table->setPrimaryKey(['id']);

        $queries = $schema->toSql($this->dbal->getDatabasePlatform());

        return $queries[0];
    }
}
