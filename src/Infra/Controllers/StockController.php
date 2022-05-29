<?php

namespace CyberTech\Infra\Controllers;

use CyberTech\Modules\Stock\Application\UseCases\Stock\CreateStock;
use CyberTech\Modules\Stock\Application\UseCases\Stock\StockInput;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StockController
{
    public function __construct(
        private readonly CreateStock $createStock
    ) {
    }

    public function create(Request $request): Response
    {
        $dataRequest = json_decode($request->getContent());
        $stockInput = new StockInput(
            typeMovement: $dataRequest->typeMovement,
            quantity: $dataRequest->quantity,
            invoice: $dataRequest->invoice,
            date: $dataRequest->date,
            supplierId: $dataRequest->supplierId,
            productId: $dataRequest->productId
        );

        $output = $this->createStock->handle($stockInput);
        return new JsonResponse($output, $output->code);
    }
}
