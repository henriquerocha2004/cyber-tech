<?php

namespace CyberTech\Infra\Storage\Database\Mysql;

use CyberTech\Infra\Storage\Database\Connection;
use PDO;

class PdoAdapterMysql implements Connection
{
    private mixed $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=127.0.0.1;dbname=cybertech", "root", "root");
    }

    public function query(string $query, mixed $params): array|bool
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function close(): void
    {
    }

    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    public function rollback(): void
    {
        $this->connection->rollBack();
    }

    public function commit(): void
    {
        $this->connection->commit();
    }
}
