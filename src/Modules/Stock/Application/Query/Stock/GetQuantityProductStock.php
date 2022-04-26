<?php

namespace CyberTech\Modules\Stock\Application\Query\Stock;

use CyberTech\Infra\Storage\Database\Connection;
use CyberTech\Modules\Stock\Domain\Entity\Stock;

class GetQuantityProductStock
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function execute(int $productId): int
    {
        $results = $this->connection->query(
            "SELECT movement_type, quantity FROM stock WHERE product_id = ?",
            [$productId]
        );
        if (empty($results)) {
            return 0;
        }

        $quantity = 0;
        foreach ($results as $result) {
            if ($result['movement_type'] == Stock::MOVEMENT_TYPE_IN) {
                $quantity += $result['quantity'];
            }

            if ($result['movement_type'] == Stock::MOVEMENT_TYPE_OUT) {
                $quantity -= $result['quantity'];
            }
        }
        return $quantity;
    }
}
