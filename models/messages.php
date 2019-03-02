<?php
class chats{
    //db stuff
    private $conn;
    private $table='users';
    //message properties
    public $username;
    public $textmsg;
    public $time;
    public $id;
    //constructor with db
   
    public function __construct($db){
        $this->conn=$db;
    }

    // get list for all users
    public function getchats(){
        // declare a query
        $query="SELECT * FROM  chats";
        // prepare the query statement
        $statement=$this->conn->prepare($query);
        // execute the query
        $statement->execute();
        return $statement;
    }
    // to display a specific user from the database                
    
     //get single user
     public function getsinglechat(){
        //query
        $query="SELECT * from chats where mg_id=mg_id LIMIT 1";
        //prepare statement
        $stmt=$this->conn->prepare($query);
        //bind the username to my named param
        $stmt->bindParam('mg_id',$this->id);
        //execute the query
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //set the props 
        $this->username=$row['username'];    
        $this->mg_id=$row['mg_id'];
        $this->textmsg=$row['textmsg'];
        $this->time=$row['time'];
        

     }
     public function createnewchat(){
        //  create new chat query
        $sql="INSERT INTO chats
        SET 
        username=:username,
        textmsg=:textmsg
        ";
        //prepare the query
        $statement=$this->conn->prepare($sql);
        //clean my data
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->textmsg=htmlspecialchars(strip_tags($this->textmsg));

        // bind my named placeholders
        $statement->bindParam(':username',$this->username);
        $statement->bindParam(':textmsg',$this->textmsg);

        // execute and check for errors
        if($statement->execute()){
            return true;
        }
        // if a problem occurs
        printf("ERROR:%s.\n",$statement->error);
        return false;
      }
     
       public function deleteuser(){
        // query
        $query='DELETE FROM chats WHERE mg_id=:id';
        // prepare the statement
        $stmt=$this->conn->prepare($query);
         // clean data
         $this->id=htmlspecialchars(strip_tags($this->id));
        // bind the parameters used
        $stmt->bindparam(':id',$this->id);
        // execute the query
        if($stmt->execute()){return true;}
        // print error if something goes wrong
        printf("ERROR:%s.\n",$stmt->error);
        return false;
   
       
    }
   
}