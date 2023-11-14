<?php
class PDOConnect
{
    protected $hot_name = "localhost";
    protected $prot = "8000";
    protected $username = "root";
    protected $password = "";
    protected $database_name = "duanmau";
    protected $db;
    function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->hot_name;dbname=$this->database_name", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function query($slq)
    {
        $slq_args = array_slice(func_get_args(), 1);
        try {
            $stml = $this->db->prepare($slq);
            $stml->execute($slq_args);
            return $stml;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
