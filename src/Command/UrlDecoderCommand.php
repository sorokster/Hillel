<?php declare(strict_types=1);

namespace Hillel\Project\Command;

use Hillel\Project\Shortener\UrlShortener;
use Hillel\Project\Storage\FileIStorage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Exception;

/**
 * Class UrlDecoderCommand
 * @package Hillel\Project\Command
 */
class UrlDecoderCommand extends Command
{
    protected static $defaultName = 'url:decode';
    protected static $defaultDescription = 'Decode url';
    protected const ARGUMENT_NAME_CODE = 'code';

    /** @return void */
    protected function configure(): void
    {
        $this->addArgument(
            self::ARGUMENT_NAME_CODE,
            InputArgument::REQUIRED,
            'Type code...'
        );
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $urlDecoder = new UrlShortener(new FileIStorage());
            $url = $urlDecoder->decode($input->getArgument(self::ARGUMENT_NAME_CODE));

            $io->writeln(sprintf('Website: %s', $url));
            return Command::SUCCESS;
        } catch (Exception $e) {
            $io->writeln($e->getMessage());
            $io->writeln('UrlShortener cannot start');
            return Command::FAILURE;
        }
    }
}
