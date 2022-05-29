<?php

use CyberTech\Modules\Attendance\Domain\Entity\Equipment;
use CyberTech\Modules\Attendance\Domain\Entity\OrderItem;
use CyberTech\Modules\Attendance\Domain\Entity\ServiceOrder;
use CyberTech\Modules\Attendance\Domain\Enums\OrderItemType;
use CyberTech\Modules\Attendance\Domain\Enums\OrderStatus;
use CyberTech\Modules\Attendance\Domain\Exceptions\OrderStatusException;

test("should create service order", function () {
    $order = new ServiceOrder(1);
    $this->assertNotEmpty($order);
});

test("should create service order with equipments", function () {
    $order = new ServiceOrder(1);
    $equipment = new Equipment(
        description: "NoteBook",
        brand: "Dell",
        model: "Inpiron 5510",
        defect: "Nao Liga",
        serial: "123456-7890",
        observations: "Com uma pequena avaria na dobradiça"
    );
    $order->addEquipment($equipment);
    $this->assertEquals("NoteBook", $order->equipments()->current()->description);
});

test('should create service order with items', function () {
    $order = new ServiceOrder(1);
    $equipment = new Equipment(
        description: "NoteBook",
        brand: "Dell",
        model: "Inpiron 5510",
        defect: "Nao Liga",
        serial: "123456-7890",
        observations: "Com uma pequena avaria na dobradiça"
    );
    $order->addEquipment($equipment);

    $orderItem = new OrderItem(
        itemId: 13,
        type: OrderItemType::Product,
        quantity: 2,
        value: 200.00
    );
    $order->addOrderItems($orderItem);
    $this->assertCount(1, $order->orderItems());
});

test('should calculate service order total', function () {
    $order = new ServiceOrder(1);
    $equipment = new Equipment(
        description: "NoteBook",
        brand: "Dell",
        model: "Inpiron 5510",
        defect: "Nao Liga",
        serial: "123456-7890",
        observations: "Com uma pequena avaria na dobradiça"
    );
    $order->addEquipment($equipment);

    $order->addOrderItems(new OrderItem(
        itemId: 13,
        type: OrderItemType::Product,
        quantity: 2,
        value: 200.00
    ));
    $order->addOrderItems(new OrderItem(
        itemId: 18,
        type: OrderItemType::Service,
        quantity: 1,
        value: 500.00
    ));

    $totalOrder = $order->getTotalValue();
    $this->assertEquals(900, $totalOrder);
});

test('should change order status to attendance', function () {
    $order = new ServiceOrder(1);
    $order->setTechnician(4);
    $this->assertEquals($order->status, OrderStatus::ATTENDANCE);
});

test('should return error when change order status to execute if status is open', function () {
    $this->expectException(OrderStatusException::class);
    $this->expectErrorMessage("cannot execute service if status is different of budget done");
    $order = new ServiceOrder(1);
    $order->executeService();
});

test('should change order status to budget finished', function () {
    $order = new ServiceOrder(1);
    $order->setTechnician(1);
    $order->budgetFinish();
    $this->assertEquals($order->status, OrderStatus::BUDGET_DONE);
});

test('shoudl change order to finish', function () {
    $order = new ServiceOrder(1);
    $order->status = OrderStatus::from('wait_payment');
    $order->orderPaid();
    $this->assertEquals($order->status, OrderStatus::FINISHED);
});