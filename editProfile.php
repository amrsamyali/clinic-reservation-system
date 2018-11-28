<?php
require_once 'security.php';
require_once 'database.php';
require_once 'personClass.php';
$person = new personClass();
$DB = new Database();
$id = $_SESSION['id'];
@$where = array(id=>$id);
$userDetails = $DB->Select('users','',$where);
if(isset($_POST['update']) && $_POST['update'] == "Update")
{
    $person->email      = $_POST['email'];
    $person->fullname   = $_POST['fullname'];
    $person->gender     = $_POST['gender'];
    $person->password   = $_POST['password'];
    $person->telephone  = $_POST['telephone'];
    $person->username   = $_POST['username'];
    $person->id         = $_SESSION['id'];
    $file = $_FILES['file'];
    $maxsize = 40000000;
    $extensions = array("jpg","png","jpge");
    $path = "images/users/";
    $url = $DB->Upload($file, $maxsize, $extensions,$path);
    if(!$url)
    {
      $person->photo=$_POST['oldPhoto'];
    }
    else 
    {
      $person->photo = $url;  
    }
    echo 'get Data :';
    print_r($person);
    $check = $person->editProfile();
    if($check)
        header ("location:index.php");
}
?>
<h6>Update</h6>
<form class="register" name="myForm" action="editProfile.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $userDetails[0]['id'];?>">
                 <div class="row form-validate">
                    <div class="col-xs-11">
                     <label for="username">FullName:</label>
                     <input type="text" name="fullname" id="checkFullname" value="<?php echo $userDetails[0]['fullname'];?>"  placeholder="FullName" class="form-control" autocomplete="off"required>
                    </div>
                    <div class="col-xs-1">
                     <div class="return" id="eFullname"></div>
                    </div>
                  </div> 
                    <div class="row form-validate">
                        <div class="col-xs-11">
                            <label for="username">Telephone:</label>
                            <input type="tel" name="telephone" id="checkTele" value="<?php echo $userDetails[0]['telephone'];?>" placeholder="Telephone" class="form-control" autocomplete="off" required> 
                        </div>
                        <div class="col-xs-1">
                            <div class="return" id="eTelephone"></div>
                        </div>
                    </div>
                     
                    <div class="row form-validate">
                        <div class="col-xs-11">
                            <label for="username">Email:</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $userDetails[0]['email'];?>" placeholder="name@example.com" autocomplete="off" required>
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender">
                        <?php
                        echo "<option value='{$userDetails[0]['gender']}'>{$userDetails[0]['gender']}</option>";
                        if($userDetails[0]['gender'] == 'Male')
                            echo '<option value="Female">Female</option>';
                        else
                            echo '<option value="Male">Male</option>';
                        ?>
                        
                        
                    </select>
                  </div>
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">UserName:</label>
                        <input type="text" name="username" placeholder="Username" value="<?php echo $userDetails[0]['username'];?>" class="form-control" id="checkUsername" autocomplete="off">
                    </div>
                      <div class="col-xs-1">
                       <div class="return" id="eUsername"></div>   
                      </div>
                  </div>  
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">Password:</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $userDetails[0]['password'];?>" id="checkPassword" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="col-xs-1">
                       <div class="return" id="ePassword"></div>   
                    </div>
                  </div>
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">Confirm Password:</label>
                        <input type="password" name="confirmPassword" class="form-control" value="<?php echo $userDetails[0]['password'];?>" id="checkConfirmPassword" placeholder="Confirm Password" autocomplete="off" required>
                    </div>
                    <div class="col-xs-1">
                       <div class="return" id="eConfirmPassword"></div>   
                    </div>
                  </div>  
                    <div class="row form-validate">
                        <div class="col-xs-5">
                        <label for="username">Profile Photo:</label>
                        <input type="file" name="file">
                        </div>
                        <div class="col-xs-5 col-xs-offset-1">
                            <img src="<?php echo $userDetails[0]['photo'];?>" title="<?php echo $userDetails[0]['fullname'];?>" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="oldPhoto" value="<?php echo $userDetails[0]['photo'];?>">
                    </div>
                <input type="submit" name="update" value="Update" class="btn btn-info">
</form>