<?php

namespace CyberTech\Infra\Controllers;

use CyberTech\Modules\Stock\Application\UseCases\Stock\CreateStock;
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
    }
}
