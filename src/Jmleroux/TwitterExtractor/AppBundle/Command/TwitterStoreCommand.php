<?php

namespace Jmleroux\TwitterExtractor\AppBundle\Command;

use Jmleroux\TwitterExtractor\Core\TwitterReader;
use Jmleroux\TwitterExtractor\Core\Saver;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Store raw tweets in database.
 * This command should be run in a cron to regularly strore new tweets.
 * @author JM Leroux <jean-marie.leroux@akeneo.com>
 */
class TwitterStoreCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('jmleroux:twitter:extract');
        $this->setDescription('Extract and store tweets.');
        $this->addArgument(
            'hastags',
            InputArgument::IS_ARRAY | InputArgument::REQUIRED,
            'Hashtags to search for'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hashtags = $input->getArgument('hastags');

        $reader = $this->getTwitterReader();
        $tweets = $reader->searchTags($hashtags);

        $output->writeln(sprintf('Found tweets = %d', count($tweets)));

        $saver = $this->getTwitterSaver();
        $countNew = $saver->saveAll($tweets);

        $output->writeln(sprintf('<info>Done.</info>New tweets = %d', $countNew));

        return 0;
    }

    /**
     * @return TwitterReader
     */
    private function getTwitterReader()
    {
        return $this->getContainer()->get('jmleroux.twitter_extractor.reader');
    }

    /**
     * @return Saver
     */
    private function getTwitterSaver()
    {
        return $this->getContainer()->get('jmleroux.twitter_extractor.saver');
    }
}
