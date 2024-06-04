<?php
// test
require_once "bootstrap.php";

use model\Customer;

$customer = new Customer();
$customer->setEmail("irgendwas@gmail.com");
$customer->setFirstName("Irgen");
$customer->setLastName("Green");
// $customer->create();

$c = Customer::get(1);
$c->setEmail("john@doe.com");
echo $c->update();