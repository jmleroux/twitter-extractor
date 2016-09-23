<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Repository;

use Doctrine\DBAL\Connection;
use Jmleroux\TwitterExtractor\Core\RepositoryInterface;

/**
 * @author JM Leroux <jmleroux.pro@gmail.com>
 */
class TwitterRepository implements RepositoryInterface
{
    /**
     * @var Connection
     */
    private $dbal;
    /**
     * @var string
     */
    private $tablename;

    /**
     * TwitterRepository constructor.
     *
     * @param Connection $dbal
     * @param  string    $tablename
     */
    public function __construct(Connection $dbal, $tablename)
    {
        $this->dbal = $dbal;
        $this->tablename = $tablename;
    }

    /**
     * @param array $tweet
     *
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    public function save(array $tweet)
    {
        $qb = $this->dbal->createQueryBuilder();
        $qb->insert($this->tablename)->values([
            'id'      => $this->dbal->quote($tweet['id'], \PDO::PARAM_STR),
            'content' => $this->dbal->quote(json_encode($tweet), \PDO::PARAM_STR),
        ]);

        return $qb->execute();
    }

    /**
     * @param string $tweetId
     *
     * @return mixed|null
     */
    public function findById($tweetId)
    {
        $qb = $this->dbal->createQueryBuilder();
        $qb->select('*')
            ->from($this->tablename)
            ->where('id = :id')->setParameter(':id', $tweetId, \PDO::PARAM_STR);

        $result = $qb->execute()->fetch();

        return $result ?: null;
    }
}
