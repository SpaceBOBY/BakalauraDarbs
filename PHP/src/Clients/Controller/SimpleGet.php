<?php
namespace App\Clients\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

/**
 * Class short summary.
 *
 * Class description.
 *
 * @version 1.0
 * @author nezgi
 */
final class SimpleGet
{
    public function __invoke(ServerRequestInterface $request)
    {
        return new Response(
            200,
            ['Content-Type' => 'text/plain'],
            json_encode(['message' => "Web service is working"])
        );
    }
}