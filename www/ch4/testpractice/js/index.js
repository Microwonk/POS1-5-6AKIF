let customersTable;
let ordersTable;
document.addEventListener('DOMContentLoaded', async () => {
    customersTable = document.querySelector('#customers');
    ordersTable = document.querySelector('#orders');

    const customers = await getAllCustomers();
    const orders = await getAllOrders();

    let customersStr = "";
    for (let customer of customers) {
        customersStr += "<tr>";
        customersStr += "<td>" + customer.CustomerID + "</td>";
        customersStr += "<td>" + customer.FirstName + "</td>";
        customersStr += "<td>" + customer.LastName + "</td>";
        customersStr += "<td>" + customer.Email + "</td>";
        customersStr += "</tr>";
    }
    customersTable.innerHTML = customersStr;

    let ordersStr = "";
    for (let order of orders) {
        ordersStr += "<tr>";
        ordersStr += "<td>" + order.OrderID + "</td>";
        ordersStr += "<td>" + order.OrderDate + "</td>";
        ordersStr += "<td>" + order.Amount + "</td>";
        ordersStr += "<td>" + order.CustomerID + "</td>";
        ordersStr += "</tr>";
    }
    ordersTable.innerHTML = ordersStr;
});

const getAllCustomers = async () => {
    let request = {
        method: 'GET',
        headers: {
            "Content-Type": "application/json",
        },
    };
    let url = "http://localhost:8083/ch4/testpractice/api/customers"
    const response = await fetch(url, request);
    return response.json();
};

const getAllOrders = async () => {
    let request = {
        method: 'GET',
        headers: {
            "Content-Type": "application/json",
        },
    };
    let url = "http://localhost:8083/ch4/testpractice/api/orders"
    const response = await fetch(url, request);
    return response.json();
};