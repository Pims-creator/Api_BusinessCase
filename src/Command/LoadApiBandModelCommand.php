<?php

namespace App\Command;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class LoadApiBandModelCommand extends Command
{
    protected static $defaultName = 'app:LoadApiBandModelCommand';

    /**
     * @var MarqueRepository
     */
    private $marqueRepository;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var ModeleRepository
     */
    private $modeleRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param MarqueRepository $marqueRepository
     * @param HttpClientInterface $client
     * @param ModeleRepository $modeleRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(MarqueRepository $marqueRepository, HttpClientInterface $client, ModeleRepository $modeleRepository, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->marqueRepository = $marqueRepository;
        $this->client = $client;
        $this->modeleRepository = $modeleRepository;
        $this->em = $em;
    }


    protected function configure(): void
    {
        $this
            ->setDescription('Load and compare DB marque modele with ApiBrand')
            ->setHelp('this command reload Api brand and model');

    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->client->request('GET', 'https://the-vehicles-api.herokuapp.com/vehicleBrands');
        $content = $response->toArray();
        dump($content);
        foreach($content as $item) {
            $brand = new Marque();
            $brand->setNom($item['brand']);
            $idApi = $item['self']['href'];
            $idapi = explode('/',$idapi);
            $idapi = end()
        }


        return Command::SUCCESS;
    }
}
