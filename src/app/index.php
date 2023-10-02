<?php
require '../../vendor/autoload.php';
require '../app/searchEngine/Finder.php';


use GuzzleHttp\Client;
use app\searchEngine\Finder;
use Symfony\Component\DomCrawler\Crawler;
    



$client = new Client();
$crawler = new Crawler();

$finder = new Finder($client, $crawler);
$items = $finder->find('https://www.alura.com.br/cursos-online-front-end');


foreach($items as $item) {
    echo $item . PHP_EOL;
}

?>