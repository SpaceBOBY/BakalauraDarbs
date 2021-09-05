<?php

namespace App\Clients\Controller;

use React\Http\Browser;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use Psr\Http\Message\StreamInterface;

final class Downloader
{
    private $client;

    public function __construct(Browser $client)
    {
        $this->client = $client;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return $this->muliple()
            ->then(function()
                   {
                       return new Response(
                        200,
                        ['Content-Type' => 'application/json'],
                         json_encode(['message' => 'Downloaded'])
                        );
                   });
    }

    private function muliple()
    {
        for($i = 0; $i < 9; $i++)
        {
            $this->download();
        }

        return $this->client->get('https://picsum.photos/200/300/')
            ->then(function(\Psr\Http\Message\ResponseInterface $response)
            {
                return $response->getBody();
            });
    }

    private function download()
    {
        return $this->client->get('https://picsum.photos/200/300/')
            ->then(function(\Psr\Http\Message\ResponseInterface $response)
            {
                return $response->getBody();
            });
    }
}

?>