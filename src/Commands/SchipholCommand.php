<?php

namespace Schiphol\Commands;

use Schiphol\Schiphol\SchipholPlanes;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SchipholCommand extends Command
{
    /**
     * @var SchipholPlanes
     */
    private $planes;

    public function __construct(SchipholPlanes $planes)
    {
        parent::__construct();

        $this->planes = $planes;
    }

    protected function configure()
    {
        $this->setName('schiphol:planes')
            ->setDescription('For plane nerds everywhere. Learn what is taking off and landing at Schiphol');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('======= Getting Aircraft Types at Schiphol Airport ======');

        $planes = $this->planes->getPlanes();

        $output->writeln($planes);
    }
}