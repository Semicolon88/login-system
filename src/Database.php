<?php
    namespace App;

    use PDO;
    use PDOException;

    class Database{
        private $host = 'localhost';
        private $user = 'root';
        private $db = 'auto';
        private $pwd = '';
        private $conn;

        public function connect(){
            $this->conn = null;
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db;
            try{
                $this->conn = new PDO($dsn,$this->user,$this->pwd);
            }catch(PDOException $e){
                die('Connection failed : '.$e->getMessage());
            }
            return $this->conn;
        }
    }
?>