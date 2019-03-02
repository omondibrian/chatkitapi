<?php
class Database{
    //db prams
    private $host='localhost';
    private $Db_name='chatkitapi2';
    private $userName='root';
    private $pass='19518b';
    private $conn;

    //db connect
    public function connect(){
        $this->conn=null;
        try{
            //the dsn
            $mysql_connection_str="mysql:host=$this->host;dbname=$this->Db_name";
            $this->conn=new PDO($mysql_connection_str,$this->userName,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOEXception $e){
            echo 'connection error:shida iko hapa'.$e->getMessage();
        }
        return $this->conn;
    }
}
?>