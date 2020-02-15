<?php
class Disbursement{

    private $connection;

    private $table_name = "disbursements";

    public $id;
    public $amount;
    public $status;
    public $bank_code;
    public $account_number;
    public $beneficiary_name;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
        $query = 'INSERT INTO disbursements (amount, status, bank_code, account_number, beneficiary_name, remark, receipt, fee) VALUES (';
        $query .= $this->amount . ', ';
        $query .= $this->status . ', ';
        $query .= $this->bank_code . ', ';
        $query .= $this->account_number . ', ';
        $query .= $this->beneficiary_name . ', ';
        $query .= $this->remark . ', ';
        $query .= $this->receipt . ', ';
        $query .= $this->fee . ')';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $stmt->close();

        $latest = $this->read();
		$this->connection->close();

        return $latest;
    }

    //R
    public function read(){
        $query = 'SELECT * FROM'. $this->table_name .' WHERE id = ' . $this->id;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
        
    }

    //U
    public function update(){
        $query = 'UPDATE disbursements SET status = ' . $this->status . ', receipt = ' . $this->receipt . ' WHERE id = ' . $this->id;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();
        $stmt->close();

        $updated = $this->read();
        $this->connection->close();

        return $updated;
    }

    //D
    public function delete(){}
}