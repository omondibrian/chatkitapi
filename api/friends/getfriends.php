<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');


require_once ("../../config/Database.php");
require_once ("../../models/friends.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//create new instance of class users and instantiate it
$friends=new friends($db);
//call all friends
$friends->username=isset($_GET['username'])?$_GET['username']:die();

$result=$friends->getlistfriends();
$row = $result->fetchAll(PDO::FETCH_COLUMN, 0);

var_dump($row);

    // // 2.determine the number of rows in that column
    // $num=$result->rowCount();
    // // 3.extract the data from each row of that column
    // if($num>0){
    //     $post_arr=array();
    //     $post_arr['data']=array();
    //     for($n=0;$n<$num;$n++){
    //         $index=$_GET['username'];
    //         $nextid=$row["$index"];
    //         $sql2="SELECT * FROM users WHERE id=:id";
    //                 //prepare the query
    //         $stmt=$db->prepare($sql2);
    //         $stmt->bindParam(':id',$nextid); 

    //     // execute the query
    //     //     $stmt->execute();//////
    //     //     while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    //     //         extract($row);
    //     //         $post_item=array(
    //     //             'id'=>$id,
    //     //             'user'=> $username,
    //     //             'avator'=> $avator,
    //     //             'firstname'=> $firstName,
    //     //             'lastname'=> $lastName,
    //     //             'address'=> $address,
    //     //             'email'=> $email 
    //     //         );
    //     //     //push to the data
    //     //     array_push($post_arr['data'],$post_item);
    //     //     //turn it to json
    //     //     }         
    //     // }            echo json_encode($post_arr);

    //     // 8.return the friends array list.
    // }else{
    //     echo json_encode(array('error'=>'no user found'));
    // }
