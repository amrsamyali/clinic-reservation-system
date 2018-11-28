<?php
require_once 'database.php';
$DB = new Database();
if(isset($_POST['send']) && $_POST['send'] == "Send")
{
    $Data['name']    = $_POST['name'];
    $Data['email']   = $_POST['email'];
    $Data['message'] = $_POST['message'];
    $check = $DB->Add('contact',$Data);
    if($check)
        header ("location:index.php");
}
?>
<section class="contact">
    <div class="container">
        <form method="post" action="contact.php">
            <div class="form-group">
                <input type="text" name="name" placeholder="Name" class="form-control input-lg" required autocomplete="off">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control input-lg" required autocomplete="off">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Message ..." rows="5" required></textarea>
            </div>
            <input type="submit" class="btn btn-success btn-lg btn-block" name="send" value="Send">

        </form>
    </div>
</section>
