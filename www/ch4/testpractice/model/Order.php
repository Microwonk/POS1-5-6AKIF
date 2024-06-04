<?php

namespace model;

class Order implements DatabaseObject
{
    private int $orderId;
    private string $orderDate;
    private float $amount;
    private int $customerId;

    private ?Customer $customer = null;

    public function create(): int
    {
        // TODO: Implement create() method.
    }

    public function update(): bool
    {
        // TODO: Implement update() method.
    }

    public static function get(int $id): ?static
    {
        // TODO: Implement get() method.
    }

    public static function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public static function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }
}