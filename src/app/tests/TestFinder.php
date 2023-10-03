<?php

namespace App\Tests;

use App\Helpers\Finder;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class TestFinder extends TestCase
{
    private $httpClientMock;
    private $url = 'url-test';

    protected function setUp(): void
    {
        $html = <<<FIM
        <html>
            <body>
                <figcaption class="orbit-caption">Curso Teste 1</figcaption>
                <figcaption class="orbit-caption">Curso Teste 2</figcaption>
                <figcaption class="orbit-caption">Curso Teste 3</figcaption>
            </body>
        </html>
        FIM;


        $stream = $this->createMock(StreamInterface::class);
        $stream
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $httpClient = $this
            ->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    public function testFinderShouldReturnCourses()
    {
        $crawler = new Crawler();
        $finder = new Finder($this->httpClientMock, $crawler);
        $items = $finder->find($this->url);

        $this->assertCount(3, $items);
        $this->assertEquals('Curso Teste 1', $items[0]);
        $this->assertEquals('Curso Teste 2', $items[1]);
        $this->assertEquals('Curso Teste 3', $items[2]);
    }
}
