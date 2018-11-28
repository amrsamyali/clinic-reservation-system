<?php
    require_once 'database.php';
    require_once 'adminClass.php';
    require_once 'dentistClass.php';
    require_once 'personClass.php';
    $admin   = new adminClass();
    $dentist = new dentistClass();
    $DB      = new Database();
    $person  = new personClass();
    
    if(isset($_POST['register']) && $_POST['register'] == "Register")
{
    $dentist->email     = $_POST['email'];
    $dentist->fullname  = $_POST['fullname'];
    $dentist->gender    = $_POST['gender'];
    $dentist->username  = $_POST['username'];
    $dentist->password  = $_POST['password'];
    $dentist->state     = 0;
    $dentist->telephone = $_POST['telephone'];
    $dentist->type      = 2;
    $file = $_FILES['file'];
    $maxsize = 40000000;
    $extensions = array("jpg","png","jpge");
    $path = "images/users/";
    $url = $DB->Upload($file,$maxsize,$extensions,$path);
    if(!$url or $url == NULL)
    {
        $dentist->photo='images/users/profile.jpg';
    }
    else 
    {
        $dentist->photo = $url;  
    }
    $check = $admin->addDentist($dentist);
    if($check)
        header ("location:index.php?page=manageUser");
}

if(isset($_GET['actionUser']) && $_GET['actionUser'] == "delete")
{
    $person->id=$_GET['id'];
    $admin->deleteUser($person);
}
if(isset($_GET['actionUser']) && $_GET['actionUser'] == "active")
{
    $person->id    = $_GET['id'];
    $person->state = $_GET['state'];
    $check = $admin->stateUser($person);
}
?>
<?php include 'manageUser.php';?>


