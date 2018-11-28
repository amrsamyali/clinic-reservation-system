<?php

require_once '../database.php';
$DB = new Database();
if(isset($_POST['username']))
{
    $username = $_POST['username'];
    $where = array(username=>$username);
    $users = $DB->Select('users','',$where);
    if(empty($users))
    {
        echo '1'; 
    }
    else
    {
        echo '0';
    }
}

