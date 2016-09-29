<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Installer\Db;

interface DbInterface
{
    /**
     * Creates the tweet store table.
     *
     * @param int $tablename
     *
     * @return string
     */
    public function getCreateSql($tablename);
}
