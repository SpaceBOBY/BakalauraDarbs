<?php

namespace App;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use LogicException;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class Router
{
    private $dispatcher;

    public function __construct(RouteCollector $routes)
    {
        $this->dispatcher = new Dispatcher\GroupCountBased($routes->getData());
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $routeInfo = $this->dispatcher->dispatch(
        $request->getMethod(), $request->getUri()->getPath());

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response(404, ['Content-Type' => 'text/plain'], 'Not found');
            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response(405, ['Content-Type' => 'text/plain'], 'Method not allowed');
            case Dispatcher::FOUND:
                $params = array_values($routeInfo[2]);
                return $routeInfo[1]($request, ...$params);
        }

        throw new LogicException('Something went wrong with routing');
    }
}

?>