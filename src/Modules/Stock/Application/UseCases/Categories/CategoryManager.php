<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Categories;

use CyberTech\Modules\Stock\Domain\Entity\Category;
use CyberTech\Modules\Stock\Domain\Repository\ICategoryRepository;
use Throwable;

class CategoryManager
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository
    ) {
    }

    public function handleCreate(CategoryInput $input): CategoryOutput
    {
        try {
            $category = new Category(
                description: $input->description
            );
            $this->categoryRepository->create($category);
            return new CategoryOutput(true);
        } catch (Throwable $t) {
            return new CategoryOutput(
                result: false,
                message: $t->getMessage(),
                error: $t,
                code: 500
            );
        }
    }

    public function handleUpdate(CategoryInput $input, int $categoryId): CategoryOutput
    {
        try {
            $category = new Category(
                description: $input->description
            );
            $this->categoryRepository->update($categoryId, $category);
            return new CategoryOutput(true);
        } catch (Throwable $t) {
            return new CategoryOutput(
                result: false,
                message: $t->getMessage(),
                error: $t
            );
        }
    }

    public function handleDelete(int $categoryId): CategoryOutput
    {
        try {
            $this->categoryRepository->delete($categoryId);
            return new CategoryOutput(true);
        } catch (Throwable $t) {
            return new CategoryOutput(
                result: false,
                message: $t->getMessage(),
                error: $t
            );
        }
    }
}
