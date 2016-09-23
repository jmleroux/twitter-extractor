<?php

namespace Jmleroux\TwitterExtractor\Core;

/**
 * @author JM Leroux <jmleroux.pro@gmail.com>
 */
interface RepositoryInterface
{
    /**
     * @param array $tweet
     *
     * @return int|null
     */
    public function save(array $tweet);

    /**
     * @param int $tweetId
     *
     * @return array|null
     */
    public function findById($tweetId);
}
