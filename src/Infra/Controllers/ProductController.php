<?php

namespace CyberTech\Infra\Controllers;

use CyberTech\Modules\Stock\Application\UseCases\Products\ProductInput;
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    public function __construct(
        private readonly ProductManager $productManager
    ) {
    }

    public function index(Request $request): Response
    {
        return new Response("Product");
    }

    public function create(Request $request): Response
    {
        $requestData = json_decode($request->getContent());
        $input = new ProductInput(
            description: $requestData->description,
            brand: $requestData->brand,
            model: $requestData->model,
            minQuantity: $requestData->min_quantity,
            categoryId: $requestData->category_id,
            costPrice: $requestData->cost_price,
            available: $requestData->available ?? true
        );

        $output = $this->productManager->handleCreate($input);
        return new JsonResponse($output, $output->code);
    }

    public function update(Request $request, int $id): Response
    {
        $requestData = json_decode($request->getContent());
        $input = new ProductInput(
            description: $requestData->description,
            brand: $requestData->brand,
            model: $requestData->model,
            minQuantity: $requestData->min_quantity,
            categoryId: $requestData->category_id,
            costPrice: $requestData->cost_price,
            available: $requestData->available ?? true
        );

        $output = $this->productManager->handleUpdate($input, $id);
        return new JsonResponse($output, $output->code);
    }

    public function delete(Request $request, int $id): Response
    {
        $output = $this->productManager->handleDelete($id);
        return new JsonResponse($output, $output->code);
    }
}
