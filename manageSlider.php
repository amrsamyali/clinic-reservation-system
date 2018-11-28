<?php 
require_once 'database.php';
$DB = new Database();
if(isset($_POST['add']) && $_POST['add'] == "Add")
{
    try 
    {
        $file = $_FILES['file'];
        $maxsize = 40000000;
        $extensions = array("jpg","jif","png","jpge");
        $path = "images/sliders/";
        $url = $DB->Upload($file, $maxsize, $extensions,$path);
        if($url == "")
        {
             echo '<script language="javascript">';
             echo 'alert("You Must Upload Photo")';
             echo '</script>'; 
        }
        else
        {
            $Data['slider'] = $url;
            $Data['state']= 0;
            $check = $DB->Add('slider',$Data);
            if($check)
                header ("location:index.php?page=manageSlider");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();   
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $id = $_GET['id'];
    $check = $DB->Delete('slider',$id);
}
if(isset($_GET['action']) && $_GET['action'] == 'active')
{
    $id = $_GET['id'];
    $activecode = $_GET['state'];
    $check = $DB->Activation($id,$activecode,'slider');
}

?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#sliders" aria-controls="home" role="tab" data-toggle="tab">Slider</a></li>
    <li role="presentation"><a href="#new" aria-controls="profile" role="tab" data-toggle="tab">New Slider</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="sliders" style="margin-top: 10px;"> 
    <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Slider</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      $slider =$DB->Select('slider');
                      for($i=0;$i<count($slider);$i++)
                      {
                          echo "<tr>
                               <td>{$slider[$i]['id']}</td>
                               <td><img src='{$slider[$i]['slider']}'  width='100%' height='200'></td>
                               ";
                               echo "<td><a href='?page=manageSlider&action=delete&id={$slider[$i]['id']}' style='margin-right:10px'><i class='fa fa-trash-o turn-off'></i></a>";
                              if($slider[$i]['state'] == 1)
                               {
                                   echo "<a href='?page=manageSlider&action=active&id={$slider[$i]['id']}&state={$slider[$i]['state']}' class='state' style='background:#57e757'>Active Now</a>";
                               }
                               else
                               {
                                   echo "<a href='?page=manageSlider&action=active&id={$slider[$i]['id']}&state={$slider[$i]['state']}' class='state' style='background:#ff3f00'>Not Active</a>";
                               }
                               
                               echo "
                               </td>
                               </tr>
                               ";
                      }
                      ?>
                    </tbody>
                </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="new">
        <h6>New Slider</h6>
        <form method="POST" action="manageSlider.php" enctype="multipart/form-data">
           <label>Upload Photo</label>
           <input type="file" name="file"  required/> <br>
           <input type="submit" class="btn btn-group-lg btn-info" name="add" value="Add">
        </form>
    </div>
</div>
