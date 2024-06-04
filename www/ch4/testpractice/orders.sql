-- Erstellen der Datenbank
CREATE DATABASE orders_db;

-- Verwenden der Datenbank
USE orders_db;

-- Erstellen der Tabellen
CREATE TABLE Customers (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100)
);

CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    OrderDate DATE,
    Amount DECIMAL(10, 2),
    CustomerID INT,
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
);

-- Einfügen von Testdaten in die Customers Tabelle
INSERT INTO Customers (FirstName, LastName, Email) VALUES
('John', 'Doe', 'john.doe@example.com'),
('Jane', 'Smith', 'jane.smith@example.com'),
('Alice', 'Johnson', 'alice.johnson@example.com'),
('Bob', 'Brown', 'bob.brown@example.com'),
('Charlie', 'Davis', 'charlie.davis@example.com');

-- Einfügen von Testdaten in die Orders Tabelle
INSERT INTO Orders (OrderDate, Amount, CustomerID) VALUES
('2024-01-01', 100.50, 1),
('2024-01-02', 200.75, 1),
('2024-01-03', 150.00, 2),
('2024-01-04', 300.25, 3),
('2024-01-05', 250.50, 4),
('2024-01-06', 175.75, 5),
('2024-01-07', 125.00, 2),
('2024-01-08', 275.25, 1),
('2024-01-09', 225.50, 3),
('2024-01-10', 180.75, 4),
('2024-01-11', 130.00, 5),
('2024-01-12', 280.25, 1),
('2024-01-13', 230.50, 3),
('2024-01-14', 185.75, 4),
('2024-01-15', 135.00, 5),
('2024-01-16', 285.25, 1),
('2024-01-17', 235.50, 3),
('2024-01-18', 190.75, 4),
('2024-01-19', 140.00, 5),
('2024-01-20', 290.25, 2);

-- Anzeigen der eingefügten Daten
SELECT * FROM Customers;
SELECT * FROM Orders;
