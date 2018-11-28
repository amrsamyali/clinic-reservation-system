<?php
require_once 'database.php';
$DB = new Database();
if(isset($_GET['action']) && $_GET['action'] == "delete")
{
    $id=$_GET['id'];
    $DB->Delete('contact',$id);
}
?>
<div>
  <ul>
    <?php 
    $DB = new Database();
    $messages = $DB->Select('contact');
    $cnt = count($messages)-1;
    for($i=0;$i<count($messages);$i++)
    {
        $message = $messages[$i]['message'];
        $countMessage = strlen($message);
        if($countMessage > 80)
        {
            $message = "";
            for($k=0;$k<80;$k++)
            {
                $char = substr($messages[$i]['message'],$k,1);
                $message .= $char;
            }
            $message .= "...";
        }
        echo "<div class='row'>
                <a href='?page=manageContact&action=delete&id={$messages[$i]['id']}' style='margin-right:10px;float:right;'><i class='fa fa-trash-o turn-off'></i></a>
                <button type='button' style='padding: 0 ;border: 0; background: none; width: 100%;outline: 0;' data-toggle='modal' data-target='#$i'>

                    <li class='list-unstyled'>
                       <div class='col-sm-2'>
                           <img src='images/users/profile.jpg' width='100px' height='100px' class='img-thumbnail' />
                       </div>
                       <div class='col-sm-7'>
                           <p class='lead' style='color: #888;'><span style='color: #555; text-transform: capitalize;'> Name : </span>{$messages[$i]['name']}</p>
                           <p class='lead' style='color: #888;'><span style='color: #555; text-transform: capitalize;'> Email : </span>{$messages[$i]['email']}</p>
                           <p class='lead' style='color: #888;'><span style='color: #555; text-transform: capitalize;'> Message : </span>{$message}</p>
                       </div>
                        <div class='col-sm-3'>
                           <p class='lead' style='color: #888;'><span style='color: #555; text-transform: capitalize;'> Date : </span>{$messages[$i]['date']}</p>
                        </div>
                     </li>
                </button> 
                   <div id='$i' class='modal fade' role='dialog'>
                   <div class='modal-dialog'>

                     <!-- Modal content-->
                     <div class='modal-content'>
                       <div class='modal-header'>
                         <button type='button' class='close' data-dismiss='modal'>&times;</button>
                         <h4 class='modal-title'>Message</h4>
                       </div>
                       <div class='modal-body'>
                         <p>{$messages[$i]['message']}</p>
                       </div>
                       <div class='modal-footer'>
                         <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                       </div>
                     </div>

                   </div>
                 </div>
           </div>";
        if($i != $cnt)
        {
            echo "<hr>";
        }
    }
    ?>
     
      
      
  </ul>
</div>