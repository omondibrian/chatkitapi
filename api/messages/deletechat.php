<?php
//get the headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,x-Requested-with');

require_once ("../../config/Database.php");
require_once ("../../models/messages.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//create new instance of class users and instantiate it
$chats=new chats($db);
//call all users
// get the raw posted data
$data=json_decode(file_get_contents("php://input"));

$chats->id=$data->id;

// create user
if ($chats->deleteuser())
{
    echo json_encode(array('message'=>" post DELETED"));
}
else{
    echo json_encode(array('message'=>" post was not DELETED sucessfully"));
}

