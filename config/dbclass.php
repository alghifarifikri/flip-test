<?php

include_once 'config.php';

class DBClass {

    private $config;
    public $connection;

    public function __construct(){
    $this->config = new Config();

    }

    public function getConnection(){
        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

?>