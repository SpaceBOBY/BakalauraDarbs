<?php

use React\Http\Server;
use App\Clients\Controller\GetAll100000;
use App\Clients\Controller\GetAll10000;
use App\Clients\Controller\SimpleGet;
use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use App\Clients\Controller\Update;
use App\Clients\Controller\Insert;
use App\Clients\Controller\Delete;
use App\Clients\Controller\Downloader;
use FastRoute\RouteParser\Std;
use React\MySQL\Factory;
use App\Clients\Query;
use React\Http\Browser;


require 'vendor/autoload.php';

$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();
$env = \Dotenv\Dotenv::create($repository, __DIR__);
$env->load();
ini_set('memory_limit', '-1');
$loop = \React\EventLoop\Loop::get();
$client = new Browser($loop);

$mysql = new Factory($loop);

$uri = getenv('DB_LOGIN') . ':' . getenv('DB_PASS') . '@' . getenv('DB_HOST') . ':' . getenv('DB_PORT') . '/' . getenv('DB_NAME');

$connection = $mysql->createLazyConnection($uri);
$query = new Query($connection);

$routes = new RouteCollector(new Std(), new GroupCountBased());
$routes->get('/SimpleGet', new SimpleGet());
$routes->get('/GetAllFromBig', new GetAll100000($query));
$routes->get('/GetAllFromSmall', new GetAll10000($query));
$routes->put('/Update/{id:\d+}', new Update($query));
$routes->post('/Insert', new Insert($query));
$routes->delete('/Delete/{id:\d+}', new Delete($query));
$routes->get('/Download', new Downloader($client));

$server = new Server(new \App\Router($routes));

$socket = new React\Socket\Server('127.0.0.1:5001', $loop);
$server->listen($socket);

echo 'Listening on ' . str_replace('tcp', 'http', $socket->getAddress()) . PHP_EOL;

$loop->run();
