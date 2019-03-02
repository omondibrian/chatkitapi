<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

require_once ("../config/Database.php");
require_once ("../models/users.php");
//instantiate the db and connect to it
$database=new Database();
$db=$database->connect();
//post objects
$user=new Users($db);
//get the id from url
$user->username=isset($_GET['username'])?$_GET['username']:die();
//get post
$result=$user->getsingle();
//create an array
$post_arr=array(
    'user'=> $user->username,
    'avator'=> $user->avator,
    'firstname'=> $user->firstName,
    'lastname'=> $user->lastName,
    'address'=> $user->address,
    'email'=> $user->email
    );
//make json
print_r(json_encode($post_arr));