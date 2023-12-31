<?php

namespace App\Helpers;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Finder
{
    private $httpClient;

    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function find(string $url): array
    {

        $res = $this->httpClient->request('GET', $url);
        $html = $res->getBody();

        $this->crawler->addHtmlContent($html);

        $filteredElements = $this->crawler->filter('figcaption.orbit-caption');

        $items = [];

        foreach ($filteredElements as $item) {
            $items[] = $item->textContent;
        }

        return $items;
    }
}
