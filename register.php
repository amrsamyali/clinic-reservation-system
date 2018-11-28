<?php 
require_once 'database.php';
$DB = new Database();
require_once 'patientClass.php';
$patient = new patientClass();
if(isset($_POST['register']) && $_POST['register'] == "Register")
{
    $patient->email     = $_POST['email'];
    $patient->fullname  = $_POST['fullname'];
    $patient->gender    = $_POST['gender'];
    $patient->username  = $_POST['username'];
    $patient->password  = $_POST['password'];
    $patient->state     = 0;
    $patient->telephone = $_POST['telephone'];
    $patient->type      = 3;
    $file = $_FILES['file'];
    $maxsize = 40000000;
    $extensions = array("jpg","png","jpge");
    $path = "images/users/";
    $url = $DB->Upload($file, $maxsize, $extensions,$path);
    if(!$url)
    {
        $patient->photo='images/users/profile.jpg';
    }
    else 
    {
      $patient->photo = $url;  
    }
    $check = $patient->register();
    if($check)
        header ("location:login.php");
}
?>
<h6>Register</h6>
<form class="register" name="myForm" action="register.php" method="post" enctype="multipart/form-data">
                 <div class="row form-validate">
                    <div class="col-xs-11">
                     <label for="username">FullName:</label>
                     <input type="text" name="fullname" id="checkFullname" placeholder="FullName" class="form-control" autocomplete="off"required>
                    </div>
                    <div class="col-xs-1">
                     <div class="return" id="eFullname"></div>
                    </div>
                  </div> 
                    <div class="row form-validate">
                        <div class="col-xs-11">
                            <label for="username">Telephone:</label>
                            <input type="tel" name="telephone" id="checkTele" placeholder="Telephone" class="form-control" autocomplete="off" required> 
                        </div>
                        <div class="col-xs-1">
                            <div class="return" id="eTelephone"></div>
                        </div>
                    </div>
                     
                    <div class="row form-validate">
                        <div class="col-xs-11">
                            <label for="username">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" autocomplete="off" required>
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">UserName:</label>
                        <input type="text" name="username" placeholder="Username" class="form-control" id="checkUsername" autocomplete="off">
                    </div>
                      <div class="col-xs-1">
                       <div class="return" id="eUsername"></div>   
                      </div>
                  </div>  
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">Password:</label>
                        <input type="password" name="password" class="form-control" id="checkPassword" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="col-xs-1">
                       <div class="return" id="ePassword"></div>   
                    </div>
                  </div>
                  <div class="row form-validate">
                    <div class="col-xs-11">
                        <label for="username">Confirm Password:</label>
                        <input type="password" name="confirmPassword" class="form-control" id="checkConfirmPassword" placeholder="Confirm Password" autocomplete="off" required>
                    </div>
                    <div class="col-xs-1">
                       <div class="return" id="eConfirmPassword"></div>   
                    </div>
                  </div> 
                    <div class="row form-validate">
                        <div class="col-xs-4">
                            <label for="username">Profile Photo:</label>
                            <input type="file" name="file">
                        </div>
                        <div class="col-xs-5">
                            <div style="color: green;font-family: Tahoma; font-weight: bold; margin-top:30px;">Photo Is Optional</div>
                        </div>
                    </div>
                        <input type="submit" name="register" value="Register" class="btn btn-info">
                </form>