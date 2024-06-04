<?php

namespace model;

class Customer extends DatabaseCommons implements DatabaseObject
{
    private int $CustomerID = 0;
    private string $FirstName;
    private string $LastName;
    private string $Email;

    public function create(): int
    {
        return self::createHelper('Customers');
    }

    public function update(): bool
    {
        return self::updateHelper('Customers', 'CustomerID');
    }

    public static function get(int $id): ?static
    {
        return self::getHelper('Customers', $id, 'CustomerID');
    }

    public static function getAll(): array
    {
        return self::getAllHelper('Customers');
    }

    public static function delete(int $id): bool
    {
        return self::deleteHelper('Customers', $id, 'CustomerID');
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