<?php

namespace Jmleroux\TwitterExtractor\Core;


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
