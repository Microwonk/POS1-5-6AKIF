<?php

namespace controller;

use model\Order;

class OrdersRESTController extends RESTController
{

    public function handleRequest() : void
    {
        match ($this->method) {
            "GET" => $this->handleGetRequest(),
            "POST" => $this->handleCreateRequest(),
            "PUT" => $this->handleUpdateRequest(),
            "DELETE" => $this->handleDeleteRequest(),
            default => $this->response("method not allowed", 405),
        };
    }

    private function handleGetRequest(): void
    {
        $model = '';
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = Order::getAll();
        } elseif($this->verb == null && sizeof($this->args) == 1) {
            $model = Order::get($this->args[0]);
        }
        $this->response($model);
    }

    private function handleCreateRequest(): void
    {
        $order = new Order();
        $order->setOrderDate($this->getDataOrNull('OrderDate'));
        $order->setAmount($this->getDataOrNull('Amount'));
        $order->setCustomerId($this->getDataOrNull('CustomerID'));

        if ($order->create()) {
            $this->response("OK", 201);
        } else {
            $this->response("FAILURE", 400);
        }
    }

    private function handleUpdateRequest(): void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $order = Order::get($this->args[0]);
            if ($order == null) {
                $this->response('ID: ' . $this->args[0] . ' not found', 404);
            } else {
                $order->setOrderDate($this->getDataOrNull('OrderDate'));
                $order->setAmount($this->getDataOrNull('Amount'));
                $order->setCustomerId($this->getDataOrNull('CustomerID'));
                if ($order->update()) {
                    $this->response("OK", 201);
                } else {
                    // TODO
                    $this->response("FAILURE", 400);
                }
            }
        } else {
            $this->response("Not found", 404);
        }
    }

    private function handleDeleteRequest(): void
    {
        if ($this->verb == null && sizeof($this->args) == 1) {
            $order = Order::get($this->args[0]);
            if ($order == null) {
                $this->response('ID: ' . $this->args[0] . ' not found', 404);
            } else {
                if (Order::delete($order->getOrderID())) {
                    $this->response("OK", 201);
                } else {
                    $this->response("FAILURE", 400);
                }
            }
        } else {
            $this->response("Not Found", 404);
        }
    }
}