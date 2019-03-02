<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');


require_once ("../config/Database.php");
require_once ("../models/users.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//create new instance of class users and instantiate it
$users=new Users($db);
//call all users
$result=$users->getUsers();
//get the row count
$num=$result->rowCount();
if($num>0){
    //post array
    $post_arr=array();
    $post_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item=array(
            'id'=>$id,
            'user'=> $username,
            'avator'=> $avator,
            'firstname'=> $firstName,
            'lastname'=> $lastName,
            'address'=> $address,
            'email'=> $email
           
        );
        //push to the data
        array_push($post_arr['data'],$post_item);
    }
//turn it to json
echo json_encode($post_arr);
}else{
    echo json_encode(array('error'=>'no user found'));
}
