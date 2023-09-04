<?php declare(strict_types=1);

namespace Hillel\Project\Command;

use Hillel\Project\Repository\FileRepository;
use Hillel\Project\Shortener\UrlShortener;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Exception;

/**
 * Class UrlEncoderCommand
 * @package Hillel\Project\Command
 */
class UrlEncoderCommand extends Command
{
    protected static $defaultName = 'url:encode';
    protected static $defaultDescription = 'Encode url';
    protected const ARGUMENT_NAME_URL = 'url';

    /** @return void */
    protected function configure(): void
    {
        $this->addArgument(
            self::ARGUMENT_NAME_URL,
            InputArgument::REQUIRED,
            'Type url...'
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
            $urlEncoder = new UrlShortener(new FileRepository());
            $code = $urlEncoder->encode($input->getArgument(self::ARGUMENT_NAME_URL));

            $io->writeln(sprintf('Code: %s', $code));
            return Command::SUCCESS;
        } catch (Exception $e) {
            $io->writeln($e->getMessage());
            $io->writeln('UrlShortener cannot start');
            return Command::FAILURE;
        }
    }
}
