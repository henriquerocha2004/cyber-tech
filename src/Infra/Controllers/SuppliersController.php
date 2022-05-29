<?php

namespace CyberTech\Infra\Controllers;

use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierInput;
use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierManager;
use CyberTech\Modules\Stock\Domain\ValueObjects\DocumentCPFCNPJ;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SuppliersController
{
    public function __construct(
        private readonly SupplierManager $supplierManager
    ) {
    }

    public function index(Request $request): Response
    {
        return new Response("Index");
    }

    public function create(Request $request): Response
    {
        $requestData = json_decode($request->getContent());
        $supplierInput = new SupplierInput(
            name: $requestData->name,
            document: new DocumentCPFCNPJ($requestData->document),
            address: $requestData->address,
            neighborhood: $requestData->neighborhood,
            city: $requestData->city,
            state: $requestData->state,
        );

        $output = $this->supplierManager->handleCreate($supplierInput);
        return new JsonResponse($output, $output->code);
    }

    public function update(Request $request, int $id): Response
    {
        $requestData = json_decode($request->getContent());
        $supplierInput = new SupplierInput(
            name: $requestData->name,
            document: new DocumentCPFCNPJ($requestData->document),
            address: $requestData->address,
            neighborhood: $requestData->neighborhood,
            city: $requestData->city,
            state: $requestData->state,
        );
        $output = $this->supplierManager->handleUpdate($supplierInput, $id);
        return new JsonResponse($output, $output->code);
    }

    public function delete(Request $request, int $id): Response
    {
        $output = $this->supplierManager->handleDelete($id);
        return new JsonResponse($output, $output->code);
    }
}
