<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Command;

use Doctrine\DBAL\Connection;
use Jmleroux\TwitterExtractor\AppBundle\Installer\Db\Mysql;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Store raw tweets in database.
 * This command should be run in a cron to regularly store new tweets.
 *
 * @author JM Leroux <jmleroux.pro@gmail.com>
 */
class InstallCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('jmleroux:twitter_extractor:install');
        $this->setDescription('Install command.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:create');
        $command->run($input, $output);

        $tweetsTable = $this->getContainer()->getParameter('twitter.table');

        /** @var Connection $dbal */
        $dbal = $this->getContainer()->get('doctrine.dbal.default_connection');
        $dbCreator = new Mysql($dbal);
        $createSql = $dbCreator->getCreateSql($tweetsTable);
        $dbal->executeQuery($createSql);

        return 0;
    }
}
