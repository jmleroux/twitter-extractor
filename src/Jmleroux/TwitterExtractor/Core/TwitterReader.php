<?php

namespace Jmleroux\TwitterExtractor\Core;

use TwitterAPIExchange;

class TwitterReader
{
    /**
     * @var string[]
     */
    protected $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function searchTags(array $hastags)
    {
        $tweets = [];
        foreach ($hastags as $tag) {
            $tweets = array_merge($tweets, $this->search($tag));
        }

        return $tweets;
    }

    public function search($search)
    {
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = sprintf('?q=#%s', $search);
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($this->options);

        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $data = json_decode($response);

        $tweets = [];

        foreach ($data->statuses as $tweet) {
            if (!isset($tweet->retweeted_status)) {
                $tweets[$tweet->id] = $tweet;
            }
        }

        return $tweets;
    }
}
