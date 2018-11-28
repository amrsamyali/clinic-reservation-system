<?php 
include 'security.php';
require_once 'database.php';
require_once 'adminClass.php';
require_once 'clinicClass.php';
$DB     = new Database();
$clinic = new clinicClass();
$admin  = new adminClass();
$webinfo = $DB->Select('aboutsite');
if(isset($_POST['save']) && $_POST['save'] == 'Save')
{
    try{
    $clinic->title      = $_POST['title'];
    $clinic->aboutUs    = $_POST['aboutUs'];
    $clinic->email      = $_POST['email'];
    $clinic->telephone  = $_POST['telephone'];
    $clinic->facebook   = $_POST['facebook'];
    $clinic->twitter    = $_POST['twitter'];
    $clinic->address    = $_POST['address'];
    $clinic->copyright  = $_POST['copyright'];
    $clinic->instagram  = $_POST['instagram'];
    $file = $_FILES['file'];
    $maxsize = 40000000;
    $extensions = array("jpg","png","jpge");
    $path = "images/";
    $url = $DB->Upload($file,$maxsize,$extensions,$path);
    if(!$url or $url == NULL)
    {
        $clinic->logo=$_POST['oldLogo'];
    }
    else 
    {
        
        $clinic->logo = $url; 
        unlink($_POST['oldLogo']);
    }
    $clinic->clinicId   = 1;
    $admin->updateClinic($clinic);
    header("location:index.php?page=clinic");
    } 
    catch (Exception $ex)
    {
        echo $ex->getMessage();  
    }
}
?>

<h6>About Web site</h6>
<form class="aboutweb" method="POST" action="clinic.php" enctype="multipart/form-data">
    
    <div class="input-group input-group-lg">
         <span class="input-group-addon" id="sizing-addon1">Title</span>
         <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['title']}";?>" placeholder="Enter The Header" name="title" aria-describedby="sizing-addon1" autocomplete="off">
    </div> <br> 
    <div class="form-group">
        <textarea name="aboutUs" class="form-control" placeholder="About Me"  autocomplete="off"><?php echo "{$webinfo[0]['aboutUs']}";?></textarea>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Email</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['email']}";?>" placeholder="Email" name="email" aria-describedby="sizing-addon1" autocomplete="off">
        </div><br class="hidden-lg hidden-md hidden-sm">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Phone</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['telephone']}";?>" placeholder="Your Phone" name="telephone" aria-describedby="sizing-addon1" autocomplete="off">
         </div>
     </div> <br>
     
    <div class="row">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Facebook</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['facebook']}";?>" placeholder=" Facebook" name="facebook" aria-describedby="sizing-addon1" autocomplete="off">
        </div><br class="hidden-lg hidden-md hidden-sm">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Twitter</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['twitter']}";?>" placeholder=" Twitter" name="twitter" aria-describedby="sizing-addon1" autocomplete="off">
         </div>
     </div> <br>
     
    <div class="row">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Address</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['address']}";?>" placeholder=" Address" name="address" aria-describedby="sizing-addon1" autocomplete="off">
        </div><br class="hidden-lg hidden-md hidden-sm">
        <div class="col-sm-6">
            <label class="label label-danger lead">Copyright</label>
            <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['copyright']}";?>" placeholder="Copyrights" name="copyright" aria-describedby="sizing-addon1" autocomplete="off">
         </div>
     </div> <br> 
     <div class="row">
        <div class="col-sm-6">
               <label class="label label-danger lead"> Instagram</label>
               <input type="text" class="form-control" value="<?php echo "{$webinfo[0]['instagram']}";?>" placeholder=" Instagram" name="instagram" aria-describedby="sizing-addon1" autocomplete="off">
        </div><br class="hidden-lg hidden-md hidden-sm">
        <div class="col-sm-6">
            <label class="label label-danger lead"> Logo</label>
            <input type="file" name="file">
            <img src="<?php echo "{$webinfo[0]['logo']}";?>" class="img-responsive img-thumbnail">
        </div>
        
        <input type="hidden" name="oldLogo" value="<?php echo "{$webinfo[0]['logo']}";?>">
    </div>     
     <input type="submit" class="btn btn-group-lg btn-info" name="save" value="Save"> 
</form>
 