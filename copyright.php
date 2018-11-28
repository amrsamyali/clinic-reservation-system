<?php 
require_once 'database.php';
$DB = new Database();
$webinfo = $DB->Select('aboutsite');
?>
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>
                    &copy;<?php echo $webinfo[0]['copyright'];?> | All Rights Reversed |
                    <a href="?page=contact">Contact Us</a>
                </p>
            </div>
            <div class="col-md-4">
                <div class="socialmedia">             
                    <a target="_blank" href="<?php echo "{$webinfo[0]['facebook']}";?>" class="hvr-bob"><i class="fa fa-facebook fa-lg"></i></a>
                    <a target="_blank" href="<?php echo "{$webinfo[0]['twitter']}";?>" class="hvr-bob"><i class="fa fa-twitter fa-lg"></i></a>
                    <a target="_blank" href="<?php echo "{$about[0]['instagram']}";?>" class="hvr-bob"><i class="fa fa-instagram fa-lg"></i></i></a>                        
                </div> 
            </div>
        </div>
    </div>
</section>