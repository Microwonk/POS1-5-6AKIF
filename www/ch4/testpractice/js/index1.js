// TEST
let ordersTable;
let customersTable;

document.addEventListener("DOMContentLoaded", async () => {
    ordersTable = document.querySelector('#orders');
    customersTable = document.querySelector('#customers');

    console.log(await doStuff());
});

const doStuff = async () => {
    const req = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            Amount: "999999",
            CustomerID: "3",
            OrderDate: "2024-01-02",
        })
    };
    const url = "http://localhost:8083/ch4/testpractice/api/orders";
    const response = await fetch(url, req);
    return response.json();
};