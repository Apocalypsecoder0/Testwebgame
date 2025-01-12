CREATE TABLE users (
    userid INT PRIMARY KEY,
    balance DECIMAL(10, 2) NOT NULL
);
CREATE TABLE training_costs (
    attackCost DECIMAL(10, 2),
    superAttackCost DECIMAL(10, 2),
    defenseCost DECIMAL(10, 2),
    superDefenseCost DECIMAL(10, 2),
    covertCost DECIMAL(10, 2),
    superCovertCost DECIMAL(10, 2),
    anticovertCost DECIMAL(10, 2),
    superAnticovertCost DECIMAL(10, 2)
);
