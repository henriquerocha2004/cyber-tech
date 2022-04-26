<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Suppliers;

use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use CyberTech\Modules\Stock\Domain\Repository\ISupplierRepository;
use Throwable;

class SupplierManager
{
    public function __construct(
        private readonly ISupplierRepository $supplierRepository
    ) {
    }

    public function handleCreate(SupplierInput $input): SupplierOutput
    {
        try {
            $supplier = new Supplier(
                name: $input->name,
                document: $input->document,
                address: $input->address,
                neighborhood: $input->neighborhood,
                city: $input->city,
                state: $input->state,
            );
            $this->supplierRepository->create($supplier);
            return new SupplierOutput(true);
        } catch (Throwable $th) {
            return new SupplierOutput(false, $th->getMessage(), $th);
        }
    }

    public function handleUpdate(SupplierInput $input, int $supplierId): SupplierOutput
    {
        try {
            $supplier = new Supplier(
                name: $input->name,
                document: $input->document,
                address: $input->address,
                neighborhood: $input->neighborhood,
                city: $input->city,
                state: $input->state,
            );

            $this->supplierRepository->update($supplierId, $supplier);

            return new SupplierOutput(true);
        }catch (Throwable $t) {
            return new SupplierOutput(false, $t->getMessage(), $t);
        }
    }

    public function handleDelete(int $supplierId): SupplierOutput
    {
        try {
            $this->supplierRepository->delete($supplierId);
            return new SupplierOutput(true);
        }catch (Throwable $t) {
            return new SupplierOutput(false, $t->getMessage(), $t);
        }
    }
}
