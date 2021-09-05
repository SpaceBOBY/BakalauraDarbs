<?php
namespace App\Clients\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Clients\Client;
use Exception;
use App\Clients\Query;

/**
 * Class short summary.
 *
 * Class description.
 *
 * @version 1.0
 * @author nezgi
 */
final class GetAll10000
{
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return $this->query->get10000()
            ->then(function (array $clients) {
                $data = array_map(function(Client $client) {
                    return $client->toArray();
                }, $clients);

                return new Response(
                           200,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => $data])
                           );
        },
        function (Exception $exception) {
            return new Response(
                           500,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => "Failed"])
                           );
        });
    }
}