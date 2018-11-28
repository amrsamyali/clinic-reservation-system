<?php 
include 'security.php';
require_once 'database.php';
$DB = new Database();
if(isset($_GET['action']) == 'delete')
{
    $id = $_GET['id'];
    $DB->Delete('prescription',$id);
}
$where = array(patientId=>$_SESSION['id']);
$prescription = $DB->Select('prescription','',$where);
$date = @date('h:m:s');

for($i=0;$i<count($prescription);$i++)
{
    echo "<div class='panel panel-primary'>  
        <div class='panel-heading'>
        <h3 class='panel-title' style='display:inline'>Prescription</h3>
        <a href='?page=prescription&action=delete&id={$prescription[$i]['id']}' class='btn btn-danger' style='float:right; margin-top:-11px; padding:10px 10px; margin-right:-16px'>Delete</a>
        </div>
        <div class='panel-body' style='color:green;font-weight:bold;font-family:Arial'>
         {$prescription[$i]['prescription']}</div>
         </div>";  
}


?>
