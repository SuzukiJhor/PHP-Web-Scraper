<?php

require '../../vendor/autoload.php';

use GuzzleHttp\Client;
use App\Helpers\Finder;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$crawler = new Crawler();

$finder = new Finder($client, $crawler);
$items = $finder->find('https://noticias.buscavoluntaria.com.br/100-melhores-livros-de-todos-os-tempos-segundo-a-bbc/');

foreach ($items as $item) {
    echo $item . PHP_EOL;
}
