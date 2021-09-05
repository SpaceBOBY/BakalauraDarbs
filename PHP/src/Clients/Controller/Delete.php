<?php
namespace App\Clients\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Clients\NotFound;
use App\Clients\Query;

/**
 * Class short summary.
 *
 * Class description.
 *
 * @version 1.0
 * @author nezgi
 */
final class Delete
{
    private $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function __invoke(ServerRequestInterface $request, string $id)
    {
        return $this->query->delete((int)$id)
            ->then(function()
                   {
                       return new Response(
                           200,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => "Deleted"])
                           );
                   })->otherwise(function(NotFound $error){
                        return new Response(
                            200,
                            ['Content-Type' => 'application/json'],
                            json_encode(['message' => "Not Found"])
                            );
    })
                   ->otherwise(function(\Exception $exception)
                   {
                       return new Response(
                           500,
                           ['Content-Type' => 'application/json'],
                            json_encode(['message' => 'Failed to delete'])
                           );

                   });
    }
}