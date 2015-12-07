<?php

//a class that provides connection to MySQL database
class Credentials
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "test";
    public $conn;
    
    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }
}

