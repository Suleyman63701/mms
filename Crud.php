<?php

require_once "DbConfig.php";

class Crud
{
    private $conn;

    public function __construct()
    {
        $this->conn = getdbconnection();
    }
    public function create($data_array, $table) //we will be adding array of data to database includes Title,Genre, and year etc.
    {
        $columns = implode(',', array_keys($data_array));
        $place_holder = ':' . implode(',:', array_keys($data_array)); //':' means PDO PREPARE STATEMENTS VALUES STARTS WITH :  https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        //$place_holder = implode(',', array_keys($data_array));

        $sql = "INSERT INTO $table ($columns) VALUES ($place_holder)";
       
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_array);
        $insertId = $this->conn->lastInsertId();
         
        return $insertId;
    }

    public function read($sql_query)
    {
        $stmt = $this->conn->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($sql_query)
    {
        $stmt= $this->conn->prepare($sql_query);
        $stmt->execute();
    }

    public function delete($sql_query)
    {
        $stmt= $this->conn->prepare($sql_query);
        $stmt->execute();
    }


}