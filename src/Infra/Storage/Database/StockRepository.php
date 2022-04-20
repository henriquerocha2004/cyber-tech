<?php

namespace CyberTech\Infra\Storage\Database;

use CyberTech\Modules\Stock\Domain\Entity\Stock;
use CyberTech\Modules\Stock\Domain\Repository\IStockRepository;

class StockRepository implements IStockRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Stock $stock): void
    {
       $this->connection->query(
           "INSERT INTO stock (movement_type, invoice, date, supplier_id, quantity, product_id) VALUES (?,?,?,?,?,?)",
           [
              $stock->typeMovement,
              $stock->invoice,
              $stock->date,
              $stock->supplierId,
              $stock->quantity,
              $stock->productId
           ]
       );
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }

    public function findFirst(): Stock|null
    {
       $result = $this->connection->query("SELECT * FROM stock LIMIT 1", []);
       if (empty($result)) {
           return null;
       }

       return new Stock(
           typeMovement: $result[0]['movement_type'],
           quantity: $result[0]['quantity'],
           invoice: $result[0]['invoice'],
           date: $result[0]['date'],
           supplierId: $result[0]['supplier_id'],
           productId: $result[0]['product_id'],
           id: $result[0]['id'],
       );
    }
}