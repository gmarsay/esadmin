<?php
namespace EsAdmin\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AssetsInstallCommand extends Command {
  protected function configure() {
    $this
      ->setName('assets:install')
      ->setDescription('Installs vendor web assets under a public web directory')
      ->setHelp('Installs vendor web assets under a public web directory')
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln('Assets install from vendor');
  }
}

