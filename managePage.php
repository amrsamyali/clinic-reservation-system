<?php 
//include 'security.php';
if(isset($_SESSION['type']) != 1)
{
    echo '<h2>This Page Not Allowed For You To Access<h2>';
}
require_once'database.php';
$DB = new Database();

if(isset($_POST['Insert']) && $_POST['Insert'] == 'Insert')
  {
   $Data1['name']  = $_POST['name'];
   $Data1['url']   = $_POST['url'];
   $Data1['state'] = 0;
   $id = $DB->Add('pages',$Data1);
   for($i=0;$i<count($_POST['typeId']);$i++)
       {
          $Data2 = array();
          $Data2['pagesId'] = $id;
          $Data2['typeUserId'] = $_POST['typeId'][$i];
          $DB->Add('pagesusers',$Data2);
       }
       header('location:index.php');
  }
  if(isset($_POST['Update']) && $_POST['Update'] == 'Update')
  {
   $Data1['name'] = $_POST['name'];
   $Data1['url'] = $_POST['url'];
   $ID = $_POST['id'];
   $DB->Update('pages',$Data1,$ID);
   $DB->Delete('pagesusers',$ID,'pagesId');
   for($i=0;$i<count($_POST['typeId']);$i++)
       {
          $Data2 = array();
          $Data2['pagesId'] = $ID;
          $Data2['typeUserId'] = $_POST['typeId'][$i];
          $DB->Add('pagesusers',$Data2);
       }
       header('location:index.php?page=managePage');
  }
  if(isset($_GET['action']) && $_GET['action'] == 'turn')
  {
      $id = $_GET['id'];
      $activecode = $_GET['state'];
      $DB->Activation($id,$activecode,'pages');
  }
  
  if(isset($_GET['action']) && $_GET['action'] == 'delete')
  {
      $id = $_GET['id'];
      $DB->Delete('pagesusers',$id,'pagesId');
      $DB->Delete('pages',$id);
  }
  $typs = $DB->Select('typeuser');
  if(isset($_GET['action']) && $_GET['action'] == 'update')
  {
      $idUpdate = $_GET['id'];
      @$where=array("id"=>$idUpdate);
      $page = $DB->Select('pages','',$where);
      ?>
                <fieldset style="">
                    <legend style="margin: 0;color: #555">Update Page</legend>
                    <form class="register" action="managePage.php" method="post" style="background-color: rgb(2, 78, 118); padding: 20px; ">
                  <div class="form-group">
                    <label for="name">Page Name:</label>
                    <input type="hidden" name="id" value="<?php echo @$page[0]['id'];?>">
                    <input type="text" name="name" value="<?php echo @$page[0]['name'];?>" class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="name">Page URL:</label>
                    <input type="text" name="url" value="<?php echo @$page[0]['url'];?>" class="form-control" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="tele">Available For:</label>
                    <?php
                    $typeIds = array();
                    $where=array("pagesId"=>@$page[0]['id']);
                    $UserType = $DB->Select('pagesusers','',$where);
                    for($i=0;$i<count($UserType);$i++)
                    {
                        $typeIds[$i] = $UserType[$i]['typeUserId'];
                    }
                    for($i=0;$i<count($typs);$i++)
                    {
                        if(in_array($typs[$i]['id'],$typeIds) == TRUE)
                        {
                           echo "<label class='checkbox-inline'><input type='checkbox' name='typeId[]' value='{$typs[$i]['id']}' checked> {$typs[$i]['typeUser']}</label>"; 
                        }
                        else
                        {
                           echo "<label class='checkbox-inline'><input type='checkbox' name='typeId[]' value='{$typs[$i]['id']}'> {$typs[$i]['typeUser']}</label>"; 
                        }
                    }
                    ?>
                  </div>
                  <input type="submit" name="Update" value="Update" class="btn btn-info">
                </form>
                </fieldset>
<?php
  }
  
  $typs = $DB->Select('typeuser');
?>
<section class="options">
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#doctor" aria-controls="home" role="tab" data-toggle="tab">Pages</a></li>
          <li role="presentation"><a href="#new" aria-controls="profile" role="tab" data-toggle="tab">New Page</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="doctor" style="margin-top: 10px;">    
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      $pages =$DB->Select('pages');
                      for($i=0;$i<count($pages);$i++)
                      {
                          echo "<tr>
                               <td>{$pages[$i]['id']}</td>
                               <td>{$pages[$i]['name']}</td>
                               <td>{$pages[$i]['url']}</td>
                               ";
                               echo "<td><a href='?page=managePage&action=delete&id={$pages[$i]['id']}' style='margin-right:10px'><i class='fa fa-trash-o turn-off'></i></a>";
                               echo "<a href='?page=managePage&action=update&id={$pages[$i]['id']}'><i class='fa fa-edit turn-off'></i></a>";
                               if($pages[$i]['state'] == 1)
                               {
                                   echo "<a href='?page=managePage&action=turn&id={$pages[$i]['id']}&state={$pages[$i]['state']}'><i class='fa fa-toggle-on  turn-on'></i></a>";
                               }
                               else
                               {
                                   echo "<a href='?page=managePage&action=turn&id={$pages[$i]['id']}&state={$pages[$i]['state']}'><i class='fa fa-toggle-off  turn-off'></i></a>";
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
                <fieldset style="">
                    <legend style="margin: 0;color: #555">Page</legend>
                    <form class="register" action="managePage.php" method="post" style="background-color: rgb(2, 78, 118); padding: 20px; ">
                  <div class="form-group">
                    <label for="name">Page Name:</label>
                    <input type="text" name="name" class="form-control" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="name">Page URL:</label>
                    <input type="text" name="url" class="form-control" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="tele">Available For:</label>
                    <?php
                    for($i=0;$i<count($typs);$i++)
                    {
                        echo "<label class='checkbox-inline'><input type='checkbox' name='typeId[]' value='{$typs[$i]['id']}'> {$typs[$i]['typeUser']}</label>"; 
                    }
                    ?>
                  </div>
                  <input type="submit" name="Insert" value="Insert" class="btn btn-info">
                </form>
                </fieldset>
            </div>
      </div>
</section>