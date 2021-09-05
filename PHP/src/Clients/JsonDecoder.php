<?php
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class short summary.
 *
 * Class description.
 *
 * @version 1.0
 * @author nezgi
 */
final class CreateClient
{
    public function __invoke(ServerRequestInterface $request)
    {
        $client = [
            'Name' => $request->getParsedBody()['Name'],
            'Age' => $request->getParsedBody()['Age']
            ];
    }
}