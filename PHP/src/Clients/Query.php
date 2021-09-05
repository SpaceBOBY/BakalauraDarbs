<?php

namespace App\Clients;

use React\MySQL\ConnectionInterface;
use React\Promise\PromiseInterface;
use React\MySQL\QueryResult;

class Query
{
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function create(string $name, int $age): PromiseInterface
    {
        return $this->connection
            ->query(
              "INSERT INTO test (Name, Age) VALUES (?, ?)",[$name, $age]
            )->then(function(QueryResult $result) use ($name, $age)
                    {
                        return new Client($result->insertId, $name, $age);
                    });
    }

    public function update(int $id, string $name, int $age): PromiseInterface
    {
        return $this->connection
            ->query(
              "UPDATE test SET Name = ?, Age = ? WHERE Id = ?",[$name, $age, $id]
            )->then(function(QueryResult $result) use ($id, $name, $age)
                    {
                        return new Client($id, $name, $age);
                    });
    }

    public function delete(int $id): PromiseInterface
    {
        return $this->connection
            ->query(
              "DELETE FROM `test` WHERE `Id` = ?",[$id]
            )->then(function(QueryResult $result)
                    {
                        if($result->affectedRows == 0)
                        {
                            throw new NotFound();
                        }
                    });
    }

    public function get10000(): PromiseInterface
    {
        return $this->connection
            ->query(
              "SELECT Id, Name, Age FROM test10000"
            )->then(function(QueryResult $result)
                    {
                        return array_map(function(array $row) {
                            return $this->mapClient($row);
                        }, $result->resultRows);
                    });
    }

    public function get100000(): PromiseInterface
    {
        return $this->connection
            ->query(
               "SELECT Id, Name, Age FROM test100000"
            )->then(function(QueryResult $result)
                    {
                        return array_map(function(array $row) {
                            return $this->mapClient($row);
                        }, $result->resultRows);
                    });
    }

    private function mapClient(array $row): Client
    {
        return new Client((int)$row['Id'], $row['Name'], (int)$row['Age']);
    }
}
