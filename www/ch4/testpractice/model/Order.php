<?php

namespace model;

class Order extends DatabaseCommons implements DatabaseObject
{
    private int $orderID = 0;
    private string $orderDate;
    private float $amount;
    private int $customerId;

    private ?Customer $customer = null;

    public function create(): int
    {
        return self::createHelper("Orders");
    }

    public function update(): bool
    {
        return self::updateHelper("Orders", "orderID");
    }

    public static function get(int $id): ?static
    {
        $ret = self::getHelper("Orders", $id, "orderID");
        $ret->setCustomer(Customer::get($ret->getCustomerId()));
        return $ret;
    }

    public static function getAll(): array
    {
        $arr = self::getAllHelper("Orders");

        foreach ($arr as $order) {
            $order->setCustomer(Customer::get($order->getCustomerId()));
        }
        return $arr;
    }

    public static function delete(int $id): bool
    {
        return self::deleteHelper("Orders", "orderID", $id);
    }

    public function getOrderID(): int
    {
        return $this->orderID;
    }

    public function setOrderID(int $orderID): void
    {
        $this->orderID = $orderID;
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