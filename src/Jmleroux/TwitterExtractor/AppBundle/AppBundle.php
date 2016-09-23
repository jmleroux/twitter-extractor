<?php

namespace Jmleroux\TwitterExtractor\AppBundle;

use Jmleroux\TwitterExtractor\AppBundle\Command\InstallCommand;
use Jmleroux\TwitterExtractor\AppBundle\Command\TwitterStoreCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author JM Leroux <jmleroux.pro@gmail.com>
 */
class AppBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function registerCommands(Application $application)
    {
        $application->add(new InstallCommand());
        $application->add(new TwitterStoreCommand());
    }
}
