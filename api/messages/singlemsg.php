<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

require_once ("../../config/Database.php");
require_once ("../../models/messages.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//post objects
$chat=new chats($db);
//get the id from url
$chat->id=isset($_GET['mg_id'])?$_GET['mg_id']:die();
//get post
$result=$chat->getsinglechat();
//create an array
$post_arr=array(
    'user'=> $chat->username,
    'id'=> $chat->id,
    'textmsg'=> $chat->textmsg,
    'time'=> $chat->time
    );
//make json
print_r(json_encode($post_arr));