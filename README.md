# flip-test

## Built With
[![PHP](https://img.shields.io/badge/PHP-7.3.x-purple.svg?style=rounded-square)](https://www.php.net/)

## Requirement
* Web Server (e.g XAMPP)
* [Postmant](https://www.getpostman.com/)

## Setup
1. Clone this repository to your local directory (e.g  D:\xampp\htdocs\flip-test)
2. Create database in your local machine (e.g `flip`) via phpmyadmin or any other DBMS
3. Go to the project directory and open file `config.php` inside config folder to set your database connection. [See here](#database-setup)
4. Open Command Prompt or Terminal and move to project directory
5. Type `php config\conn.php` to run database migration

## Database Setup
Open `config.php` file inside config to setup your database.
```
public $host     = "localhost";
public $username = "root";
public $password = "";
public $database = "flip";
```

## End Point
1. Create Disbursement
	* cURL
	Open Command Prompt or Terminal and Type :
	```
	curl -i -X POST -d 
    "{
        \"amount\": 40000,
        \"status\": \"PENDING\",
        \"bank_code\": \"bni\",
        \"account_number\": 001,
        \"beneficiary_name\": \"PT FLIP\",
        \"remark\": \"Sample Remark\"
        \"fee\": 4000
    }"
    http://localhost/flip-test/disburse/create.php
	```
	* Tester
	```
	URL:	http://localhost/flip-test/disburse/create.php
	Method: POST
	Header: 
	{
		Content-Type: application/json
	}
	URL Params: 
		-
	Body Params:
	{
	    "amount": 40000,
        "status": "PENDING",
        "bank_code": "bni",
        "account_number": 001,
        "beneficiary_name": "PT FLIP",
        "remark": "Sample Remark"
        "fee": 4000
	}
	```

2. Update Disbursement
    * cURL
    Open Command Prompt or Terminal and Type :
    ```
    curl -i -X PATCH -d 
    "{
        \"status\": \"SUCCESS\",
        \"receipt\": \"https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg\"
    }"
    http://localhost/flip-test/disburse/update.php
    ```
    * Tester
    ```
    URL:	http://localhost/flip-test/disburse/update.php
    Method: PATCH
    Header: 
    {
        Content-Type: application/json
    }
    URL Params: 
        -
    Body Params:
    {
        "status": "SUCCESS",
        "receipt": "https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg"
    }
    ```

2. Check Disbursement Status
	* cURL
	Open Command Prompt or Terminal and Type :
	```
	curl -i -X GET http://localhost/flip-test/disburse/read.php?id=1
	```
	* API Tester
	```
	URL:	http://localhost/flip-test/disburse/read.php?id=1
	Method: GET
	Header: 
	{
		Content-Type: application/json
	}
	URL Params: 
		id: disbursement id
	Body Params:
		-
	```
