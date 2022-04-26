<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Products;

use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Repository\IProductRepository;
use Throwable;

class ProductManager
{
    public function __construct(
        private readonly IProductRepository $productRepository
    ){
    }

    public function handleCreate(ProductInput $input): ProductOutput
    {
        try {
            $product = new Product(
                $input->description,
                $input->brand,
                $input->model,
                $input->minQuantity,
                $input->categoryId,
                $input->costPrice,
                $input->available,
                $input->salePrice
            );

            $this->productRepository->create($product);
            return new ProductOutput(
                result: true
            );
        }catch (Throwable $t) {
            return new ProductOutput(
                result: false,
                message: $t->getMessage(),
                error: $t,
                code: 500
            );
        }
    }

    public function handleUpdate(ProductInput $input, int $productId): ProductOutput
    {
        try {
            $product = new Product(
                $input->description,
                $input->brand,
                $input->model,
                $input->minQuantity,
                $input->categoryId,
                $input->costPrice,
                $input->available,
                $input->salePrice
            );

            $this->productRepository->update($productId, $product);
            return new ProductOutput(true);
        }catch (Throwable $t) {
            return new ProductOutput(
                result: false,
                message: $t->getMessage(),
                error: $t,
                code: 500
            );
        }
    }

    public function handleDelete(int $productId): ProductOutput
    {
        try {
            $this->productRepository->delete($productId);
            return new ProductOutput(true);
        }catch (Throwable $t) {
            return new ProductOutput(
                result: false,
                message: $t->getMessage(),
                error: $t,
                code: 500
            );
        }
    }
}