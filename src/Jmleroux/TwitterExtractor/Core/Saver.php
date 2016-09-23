<?php

namespace Jmleroux\TwitterExtractor\Core;

class Saver
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $tweets
     *
     * @return int
     */
    public function saveAll(array $tweets)
    {
        $countSaved = 0;
        foreach ($tweets as $tweet) {
            $countSaved += $this->saveOne($tweet) ? 1 : 0;
        }

        return $countSaved;
    }

    /**
     * @param \stdClass $tweet
     *
     * @return null
     */
    public function saveOne(\stdClass $tweet)
    {
        if (null === $this->repository->findById($tweet->id)) {
            return $this->repository->save((array) $tweet);
        }

        return null;
    }
}
