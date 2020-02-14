CREATE DATABASE flip;

use flip;

CREATE TABLE 'disbursements' (
    'id' INT PRIMARY KEY AUTO_INCREMENT,
    'amount' DECIMAL(12,0) NOT NULL,
    'status' VARCHAR(10) NOT NULL,
    'timestamp' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    'bank_code' VARCHAR(20) NOT NULL,
    'account_number' VARCHAR(20) NOT NULL,
    'beneficiary_name' VARCHAR(30) NOT NULL,
    'remark' TEXT,
    'receipt' TEXT,
    'time_served' TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    'fee' DECIMAL(12,0)
);