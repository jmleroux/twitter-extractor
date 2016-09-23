<?php

namespace Jmleroux\TwitterExtractor\AppBundle;

use Jmleroux\TwitterExtractor\AppBundle\Command\InstallCommand;
use Jmleroux\TwitterExtractor\AppBundle\Command\TwitterStoreCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function registerCommands(Application $application)
    {
        $application->add(new InstallCommand());
        $application->add(new TwitterStoreCommand());
    }
}
