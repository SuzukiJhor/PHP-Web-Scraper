<?php 

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'https://www.alura.com.br/cursos-online-front-end');
$html = $response->getBody();