<?php

namespace model;

class Customer implements DatabaseObject
{
    private int $CustomerID;
    private string $FirstName;
    private string $LastName;
    private string $Email;

    public function create(): int
    {
        return DatabaseHelper::create($this, 'Customers');
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

    public function getCustomerID(): int
    {
        return $this->CustomerID;
    }

    public function setCustomerID(int $CustomerID): void
    {
        $this->CustomerID = $CustomerID;
    }

    public function getFirstName(): string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): void
    {
        $this->FirstName = $FirstName;
    }

    public function getLastName(): string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): void
    {
        $this->LastName = $LastName;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): void
    {
        $this->Email = $Email;
    }
}