<?php

class Db
{
    protected $connection;
    static protected $instance;

    static public function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $dbHost = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "irangiro_social";
        $dbport = "3306";
        // $conn = new mysqli( 'localhost','fayzo','fayzo123','retrieve_data','3306');
        $this->connection = new Mysqli($dbHost, $dbUsername, $dbPassword, $dbName,$dbport);

        if (mysqli_connect_errno()) {
            die("database connection failed:" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
        } else {
            // echo "is OK";
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeDb()
    {
        if (isset($this->connection)) {
            $this->connection->close();
            unset($this->connection);
        }
    }
}

$dbase = new Db();
$db= $dbase->getConnection();
global $db;

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>