<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Stock;

use CyberTech\Modules\Stock\Domain\Entity\Stock;
use CyberTech\Modules\Stock\Domain\Repository\IStockRepository;
use Throwable;

class CreateStock
{
    public function __construct(
        private readonly IStockRepository $stockRepository
    ){
    }

    public function handle(StockInput $input): StockOutput
    {
        try {
            $stock = new Stock(
                typeMovement: $input->typeMovement,
                quantity: $input->quantity,
                invoice: $input->invoice,
                date: $input->date,
                supplierId: $input->supplierId,
                productId: $input->productId
            );

            $this->stockRepository->insert($stock);
            return new StockOutput(true);
        }catch (Throwable $t) {
           return new StockOutput(
               result: false, message: $t->getMessage(), error: $t
           );
        }
    }
}