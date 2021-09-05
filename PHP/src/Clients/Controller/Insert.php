<?php
namespace App\Clients\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Clients\Query;
use App\Clients\Client;
/**
 * Class short summary.
 *
 * Class description.
 *
 * @version 1.0
 * @author nezgi
 */
final class Insert
{
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $params = (array)json_decode($request->getBody()->getContents());

        $name = $params['name'];
        $age = $params['age'];

        return $this->query->create($name, (int)$age)
            ->then(function(Client $client)
                   {
                       return new Response(
                           200,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => $client->toArray()])
                           );
                   },
                   function(\Exception $exception)
                   {
                       return new Response(
                           500,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => 'Failed to add'])
                           );

                   });
    }
}