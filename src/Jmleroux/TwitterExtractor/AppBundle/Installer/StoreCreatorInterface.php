<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Installer;

interface StoreCreatorInterface
{
    /**
     * Create the store: database table, collection, file, ...
     *
     * @return mixed
     */
    public function createStore();
}
