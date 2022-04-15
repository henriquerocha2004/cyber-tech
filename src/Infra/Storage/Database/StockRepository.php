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

    public function getProductQuantity(int $productId): int
    {
        // TODO: Implement getProductQuantity() method.
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }
}