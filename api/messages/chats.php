<?php 
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');


require_once ("../../config/Database.php");
require_once ("../../models/messages.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//create new instance of class users and instantiate it
$chats=new chats($db);
//call all users
$result=$chats->getchats();
//get the row count
$num=$result->rowCount();
if($num>0){
    //chats array
    $chats_arr=array();
    $chats_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $chats_item=array(
            'id'=>$mg_id,
            'user'=> $username,
            'textmsg'=> $textmsg,
            'time'=> $time
           
        );
        //push to the data
        array_push($chats_arr['data'],$chats_item);
    }
//turn it to json
echo json_encode($chats_arr);
}else{
    echo json_encode(array('error'=>'no chats found'));
}
