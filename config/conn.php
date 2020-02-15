<?php

include_once 'dbclass.php';

    try 
        {
            $dbclass = new DBClass(); 
            $connection = $dbclass->getConnection();
            $sql = file_get_contents("../migration/database.sql"); 
            mysqli_query($connection, $sql);
            echo "Database and tables created successfully!";
        }
    catch(PDOException $e)
        {
            echo $e->getMessage();
        }

?>