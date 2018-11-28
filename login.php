<?php 
if(!isset($_SESSION)){session_start();}
include 'header.php';
require_once 'database.php';
require_once 'personClass.php';
$DB = new Database();
$person = new personClass();
if(isset($_POST['login']) && $_POST['login'] == "Login")
{
    $person->username = $_POST['username'];
    $person->password = $_POST['password'];
    $check = $person->login();
    if($check)
        header ("location:index.php");      
}
?>
<form class="form-horizontal login" method="POST" action="login.php">
    <input class="form-control input-lg" type="text" name="username" placeholder="UserName" autocomplete="off" required>
    <input class="form-control input-lg" type="password" name="password" placeholder="Password" autocomplete="new-password" required>
    <input class="btn btn-block btn-info" type="submit" name="login" value="Login">
</form>
<?php include 'footer.php';?>
