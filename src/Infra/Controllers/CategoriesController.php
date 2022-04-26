<?php

namespace CyberTech\Infra\Controllers;

use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryInput;
use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController
{
    public function __construct(
        private readonly CategoryManager $categoryManager
    ) {
    }

    public function index(Request $request): Response
    {
        return new Response("Index");
    }

    public function create(Request $request): Response
    {
        $dataRequest = json_decode($request->getContent());
        $input = new CategoryInput(
            description: $dataRequest->description
        );

        $output = $this->categoryManager->handleCreate($input);
        return new JsonResponse($output, $output->code);
    }

    public function update(Request $request, int $id): Response
    {
        $dataRequest = json_decode($request->getContent());
        $input = new CategoryInput(
            description: $dataRequest->description
        );

        $output = $this->categoryManager->handleUpdate($input, $id);
        return new JsonResponse($output, $output->code);
    }

    public function delete(Request $request, int $id): Response
    {
        $output = $this->categoryManager->handleDelete($id);
        return new JsonResponse($output, $output->code);
    }
}
