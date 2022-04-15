<?php

namespace CyberTech\Modules\Stock\Domain\Repository;

use CyberTech\Modules\Stock\Domain\Entity\Stock;

interface IStockRepository
{
  public function insert(Stock $stock): void;
  public function getProductQuantity(int $productId): int;
  public function clear(): void;
}