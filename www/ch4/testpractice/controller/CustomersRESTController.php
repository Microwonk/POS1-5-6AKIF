<?php

namespace controller;

use model\Customer;

class CustomersRESTController extends RESTController
{

    public function handleRequest(): void
    {
        match ($this->method) {
            "POST" => $this->handleCreateRequest(),
            "GET" => $this->handleGetRequest(),
            "PUT" => $this->handleUpdateRequest(),
            "DELETE" => $this->handleDeleteRequest(),
            default => $this->response('method not allowed', 405),
        };
    }

    private function handleGetRequest(): void
    {
        $model = '';
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = Customer::getAll();
        } else if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Customer::get($this->args[0]);
        }
        $this->response($model);
    }

    private function handleCreateRequest() : void
    {
        $customer = new Customer();
        $customer->setEmail($this->getDataOrNull('Email'));
        $customer->setFirstName($this->getDataOrNull('FirstName'));
        $customer->setLastName($this->getDataOrNull('LastName'));

        if ($customer->create()) {
            $this->response("OK", 201);
        } else {
            // TODO actually make the errors appear
            $this->response("FAILURE", 400);
        }
    }

    private function handleUpdateRequest() : void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $customer = Customer::get($this->args[0]);
            if ($customer == null) {
                $this->response('ID: ' . $this->args[0] . ' not found', 404);
            } else {
                $customer->setEmail($this->getDataOrNull('Email'));
                $customer->setFirstName($this->getDataOrNull('FirstName'));
                $customer->setLastName($this->getDataOrNull('LastName'));
                if ($customer->update()) {
                    $this->response('OK', 201);
                } else {
                    // TODO actually make the errors appear
                    $this->response("FAILURE", 400);
                }
            }
        } else {
            $this->response("Not Found", 404);
        }
    }

    private function handleDeleteRequest() : void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $customer = Customer::get($this->args[0]);
            if ($customer == null) {
                $this->response('ID: ' . $this->args[0] . ' not found', 404);
            } else {
                // oder
                // Customer::delete($this->args[0]);
                if (Customer::delete($customer->getCustomerID())) {
                    $this->response('OK', 201);
                } else {
                    $this->response("FAILURE", 400);
                }
            }
        } else {
            $this->response("Not Found", 404);
        }
    }
}