<?php
    class friends{
        public $listfriends=array();
        public $conn;
        public $id;
        public $username;

        public function __construct($db){
            $this->conn=$db;
        }
        public function connect($db){
            $this->conn=$db;
        }
        public function getlistfriends(){
            // 1.extract the data from the column belonging to the specific user_error
            $sql="SELECT :username FROM friends";
                //prepare statement
                $stmt=$this->conn->prepare($sql);
                //bind the username to my named param
                $stmt->bindParam(':username',$this->username); 
            // execute the query
            $stmt->execute();
            return $stmt;
            $row = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

var_dump($row);
        }





    }