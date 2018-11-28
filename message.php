<?php 
include 'security.php';
require_once 'database.php';
$DB = new Database();
if(isset($_GET['action']) == 'delete')
{
    $id = $_GET['id'];
    $DB->Delete('message',$id);
}
$where = array("receiverId"=>$_SESSION['id']);
$message = $DB->Select('message','',$where);

for($i=0;$i<count($message);$i++)
{
    echo "<div class='panel panel-primary'>  
        <div class='panel-heading'>
        <h3 class='panel-title' style='display:inline'>Confirmation Message</h3>
        <a href='?page=message&action=delete&id={$message[$i]['id']}' class='btn btn-danger' style='float:right; margin-top:-11px; padding:10px 10px; margin-right:-16px'>Delete</a>
        </div>
        <div class='panel-body' style='color:green;font-weight:bold;font-family:Arial'>
         {$message[$i]['message']}</div>
         </div>";  
}
?>
