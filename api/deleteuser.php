<?php
//get the headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,x-Requested-with');

require_once("../config/Database.php");
require_once("../models/users.php");

// instantiate and connect to the database
$database=new Database();
$db=$database->connect();
//post objects
$user=new Users($db);
// get the raw posted data
$data=json_decode(file_get_contents("php://input"));

// set the propperties
$user->id=$data->id;

// create new user
if ($user->deleteuser())
{
    echo json_encode(array('message'=>" user info deleted"));
}
else{
    echo json_encode(array('message'=>" user info not deleted"));
}

