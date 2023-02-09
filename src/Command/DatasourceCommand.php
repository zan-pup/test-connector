<?php

namespace App\Command;

use App\Service\InsertProducts;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatasourceCommand extends Command
{
    public function __construct(
        private InsertProducts $insertProducts
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName("app:datasource")
            ->addOption("sample-individual-option");
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->insertProducts->insertProducts();

        return 0;
    }

}