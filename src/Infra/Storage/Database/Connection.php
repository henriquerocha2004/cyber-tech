<?php

namespace CyberTech\Infra\Storage\Database;

interface Connection
{
    public function query(string $stmt, mixed $params): mixed;
    public function close(): void;
    public function beginTransaction(): void;
    public function rollback(): void;
    public function commit(): void;
}
