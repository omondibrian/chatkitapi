<?php
class Users{
    //db stuff
    private $conn;
    private $table='users';
    //message properties
    public $username;
    public $avator;
    public $time;
    public $firstName;
    public $lastName;
    public $address;
    public $email;
    public $id;
    //constructor with db
   
    public function __construct($db){
        $this->conn=$db;
    }

    // get list for all users
    public function getUsers(){
        // declare a query
        $query="SELECT * FROM  users";
        // prepare the query statement
        $statement=$this->conn->prepare($query);
        // execute the query
        $statement->execute();
        return $statement;
    }
    // to display a specific user from the database                
    
     //get single user
     public function getsingle(){
        //query
        $query="SELECT * from users where username=:username LIMIT 1";
        //prepare statement
        $stmt=$this->conn->prepare($query);
        //bind the username to my named param
        $stmt->bindParam(':username',$this->username);
        //execute the query
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //set the props 
        $this->username=$row['username'];    
        $this->avator=$row['avator'];
        $this->firstName=$row['firstName'];
        $this->lastName=$row['lastName'];
        $this->address=$row['address'];
        $this->email=$row['email'];
        $this->id=$row['id'];

     }
     public function createUser(){
        //  create new user query
        $sql="INSERT INTO users
        SET 
        firstName=:firstName,
        lastName=:lastName,
        username=:username,
        address=:address,
        email=:email,
        avator=:avator";
        //prepare the query
        $statement=$this->conn->prepare($sql);
        //clean my data
        $this->firstName=htmlspecialchars(strip_tags($this->firstName));
        $this->lastName=htmlspecialchars(strip_tags($this->lastName));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->avator=htmlspecialchars(strip_tags($this->avator));

        // bind my named placeholders
        $statement->bindParam(':firstName',$this->firstName);
        $statement->bindParam(':lastName',$this->lastName);
        $statement->bindParam(':username',$this->username);
        $statement->bindParam(':address',$this->address);
        $statement->bindParam(':email',$this->email);
        $statement->bindParam(':avator',$this->avator);

        // execute and check for errors
        if($statement->execute()){
            return true;
        }
        // if a problem occurs
        printf("ERROR:%s.\n",$statement->error);
        return false;
      }
      public function updateUser(){
        //create query
        $sql="UPDATE
        users
    SET
        username =:username ,
        firstName =:firstName,
        lastName =:lastName,
        address =:address,
        email =:email,
        avator=:avator
        
    WHERE id=:id;";
         //prepare the query
         $statement=$this->conn->prepare($sql);
         //clean my data
         $this->firstName=htmlspecialchars(strip_tags($this->firstName));
         $this->lastName=htmlspecialchars(strip_tags($this->lastName));
         $this->username=htmlspecialchars(strip_tags($this->username));
         $this->address=htmlspecialchars(strip_tags($this->address));
         $this->email=htmlspecialchars(strip_tags($this->email));
         $this->avator=htmlspecialchars(strip_tags($this->avator));
         $this->id=htmlspecialchars(strip_tags($this->id));

 
         // bind my named placeholders
         $statement->bindParam(':firstName',$this->firstName);
         $statement->bindParam(':lastName',$this->lastName);
         $statement->bindParam(':username',$this->username);
         $statement->bindParam(':address',$this->address);
         $statement->bindParam(':email',$this->email);
         $statement->bindParam(':avator',$this->avator);
         $statement->bindParam(':id',$this->id);

 
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
        $query='DELETE FROM users WHERE id=:id';
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