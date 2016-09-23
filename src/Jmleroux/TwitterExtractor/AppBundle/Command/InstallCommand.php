<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Command;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Jmleroux\TwitterExtractor\Core\TwitterReader;
use Jmleroux\TwitterExtractor\Core\Saver;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Store raw tweets in database.
 * This command should be run in a cron to regularly strore new tweets.
 * @author JM Leroux <jean-marie.leroux@akeneo.com>
 */
class InstallCommand extends ContainerAwareCommand
{
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
        $database = $this->getContainer()->getParameter('database_name');
        $command = $this->getApplication()->find('doctrine:database:create');
        $command->run($input, $output);

        $tweetsTable = $this->getContainer()->getParameter('twitter.table');
        $schema = new Schema();

        $table = $schema->createTable($tweetsTable);
        $table->addColumn('id', 'string', ['length' => 50]);
        $table->addColumn('content', 'text');
        $table->setPrimaryKey(['id']);

        /** @var Connection $dbal */
        $dbal = $this->getContainer()->get('doctrine.dbal.default_connection');
        $queries = $schema->toSql($dbal->getDatabasePlatform());

        $dbal->executeQuery($queries[0]);

        return 0;
    }
}
