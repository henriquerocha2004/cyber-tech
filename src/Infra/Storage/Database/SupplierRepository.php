<?php

namespace CyberTech\Infra\Storage\Database;

use CyberTech\Modules\Stock\Domain\Collections\SupplierCollection;
use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use CyberTech\Modules\Stock\Domain\Repository\ISupplierRepository;
use CyberTech\Modules\Stock\Domain\ValueObject\DocumentCPFCNPJ;

class SupplierRepository implements ISupplierRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Supplier $supplier): void
    {
        $this->connection->query(
            "INSERT INTO suppliers (name, document, address, neighborhood, city, state) VALUES (?,?,?,?,?,?)",
            [
                $supplier->name,
                $supplier->document->getValue(),
                $supplier->address,
                $supplier->neighborhood,
                $supplier->city,
                $supplier->state
            ]
        );
    }

    public function find(int $supplierId): ?Supplier
    {
        $search = $this->connection->query("SELECT * FROM suppliers WHERE id = ?", [$supplierId]);

        if (empty($search)) {
            return null;
        }

        return new Supplier(
            name: $search[0]['name'],
            document: new DocumentCPFCNPJ($search[0]['document']),
            address: $search[0]['address'],
            neighborhood: $search[0]['neighborhood'],
            city: $search[0]['city'],
            state: $search[0]['state'],
            id: $search[0]['id']
        );
    }

    public function update(int $supplierId, Supplier $supplier): void
    {
        $this->connection->query(
            "UPDATE suppliers SET name = ?, document = ?, address = ?, neighborhood = ?, city = ?, state = ? WHERE id = ?",
            [
                $supplier->name,
                $supplier->document->getValue(),
                $supplier->address,
                $supplier->neighborhood,
                $supplier->city,
                $supplier->state,
                $supplierId
            ]
        );
    }

    public function delete(int $supplierId): void
    {
        $this->connection->query("DELETE FROM suppliers WHERE id = ?", [$supplierId]);
    }

    public function clear(): void
    {
        $this->connection->query("TRUNCATE TABLE suppliers", []);
    }

    public function findAll(): SupplierCollection|null
    {
        $results = $this->connection->query("SELECT * FROM suppliers", []);
        if (empty($results)) {
            return null;
        }

        $suppliers = new SupplierCollection();
        foreach ($results as $result) {
            $product = new Supplier(
                name: $result['name'],
                document: new DocumentCPFCNPJ($result['document']),
                address: $result['address'],
                neighborhood: $result['neighborhood'],
                city: $result['city'],
                state: $result['state'],
                id: $result['id']
            );
            $suppliers->add($product);
        }

        return $suppliers;
    }

    public function findFirst(): Supplier|null
    {
        $result = $this->connection->query("SELECT * FROM suppliers LIMIT 1", []);
        if (empty($result)) {
            return null;
        }

        return new Supplier(
            name: $result[0]['name'],
            document: new DocumentCPFCNPJ($result[0]['document']),
            address: $result[0]['address'],
            neighborhood: $result[0]['neighborhood'],
            city: $result[0]['city'],
            state: $result[0]['state'],
            id: $result[0]['id']
        );
    }
}