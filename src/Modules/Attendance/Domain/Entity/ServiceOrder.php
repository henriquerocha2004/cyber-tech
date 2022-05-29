<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

use CyberTech\Modules\Attendance\Domain\Collections\EquipmentCollection;
use CyberTech\Modules\Attendance\Domain\Collections\OrderItemsCollection;
use CyberTech\Modules\Attendance\Domain\DomainService\OrderServiceCode;
use CyberTech\Modules\Attendance\Domain\Enums\OrderStatus;
use CyberTech\Modules\Attendance\Domain\Exceptions\OrderStatusException;

class ServiceOrder
{
    /**
     *  STATUS DE UMA ORDEM DE SERVIÇO
     *  1 -  Aberta
     *  2 -  Em atendimento
     *  3 -  Orçamento Realizado
     *  7 -  Executando Serviço.
     *  9 -  Aguardando Pagamento
     *  11 - Encerrado.
     *  12 - Cancelado.
     */


    public string $code;
    public string $openDate;
    public readonly string $closeDate;
    public readonly string $cancelDate;
    public OrderStatus $status;
    public readonly int $clientId;
    private EquipmentCollection $orderEquipments;
    private OrderItemsCollection $orderItems;
    public int $responsibleTechnician;

    public function __construct(int $clientId)
    {
        $this->clientId = $clientId;
        $this->code = OrderServiceCode::generate();
        $this->openDate = date('Y-m-d');
        $this->orderEquipments = new EquipmentCollection();
        $this->orderItems = new OrderItemsCollection();
        $this->status = OrderStatus::OPEN;
    }

    public function addEquipment(Equipment $equipment): void
    {
        $this->orderEquipments->add($equipment);
    }

    public function equipments(): EquipmentCollection
    {
        return $this->orderEquipments;
    }

    public function addOrderItems(OrderItem $orderItem): void
    {
        $this->orderItems->add($orderItem);
    }

    public function orderItems(): OrderItemsCollection
    {
        return $this->orderItems;
    }

    public function getTotalValue(): float
    {
        if ($this->orderItems->count() <= 0) {
            return 0.00;
        }
        return $this->orderItems->getTotal();
    }

    /**
     * @throws OrderStatusException
     */
    public function setTechnician(int $id): void
    {
        if ($this->status != OrderStatus::OPEN) {
            throw new OrderStatusException("cannot set reponsible if order service status is not open");
        }

        $this->responsibleTechnician = $id;
        $this->status = OrderStatus::ATTENDANCE;
    }

    /**
     * @throws OrderStatusException
     */
    public function budgetFinish(): void
    {
        if ($this->status != OrderStatus::ATTENDANCE) {
            throw new OrderStatusException("cannot finish budget if order status is different of attendance");
        }

        $this->status = OrderStatus::BUDGET_DONE;
    }

    /**
     * @throws OrderStatusException
     */
    public function executeService(): void
    {
        if ($this->status != OrderStatus::BUDGET_DONE) {
            throw new OrderStatusException("cannot execute service if status is different of budget done");
        }

        $this->status = OrderStatus::EXECUTE_SERVICE;
    }

    /**
     * @throws OrderStatusException
     */
    public function serviceDone(): void
    {
        if ($this->status != OrderStatus::EXECUTE_SERVICE) {
            throw new OrderStatusException("cannot declare service done if status is different of execute service");
        }

        $this->status = OrderStatus::WAIT_PAYMENT;
    }

    /**
     * @throws OrderStatusException
     */
    public function orderPaid(): void
    {
        if ($this->status != OrderStatus::WAIT_PAYMENT) {
            throw new OrderStatusException("cannot finished service order because order status is not wait payment");
        }
        $this->closeDate = date('Y-m-d');
        $this->status = OrderStatus::FINISHED;
    }

    /**
     * @throws OrderStatusException
     */
    public function cancel(): void
    {
        if ($this->status == OrderStatus::FINISHED) {
            throw new OrderStatusException("cannot cancel service order because order status is finished");
        }
        $this->cancelDate = date('Y-m-d');
        $this->status = OrderStatus::CANCELLED;
    }
}