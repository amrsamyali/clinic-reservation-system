<?php 
if(!isset($_SESSION))
{
    session_start();
}
require_once 'database.php';
$DB = new Database();
$about = $DB->Select('aboutSite');
?>
<section class="slider">
    <div class="container">
        <div class="intro">
            <div class="row">
                <div class="col-md-6">
                    <a href="index.php"><img src="<?php echo $about[0]['logo'];?>" width="100" height="50"></a>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <span>Call Us at (<h3><?php echo $about[0]['telephone'];?></h3>)</span>
                    <p><?php echo $about[0]['address'];?></p>
                </div>  
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $about[0]['title'];?></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li <?php if (@($_GET['page']) == 'contact') echo "class='active'";?>><a href="?page=contact">Contact</a></li>
                  <li <?php if (@($_GET['page']) == 'cast') echo "class='active'";?>><a href="?page=cast">Doctors</a></li>
                  <?php 
                  if(isset($_SESSION['username']))
                  {
                  ?> 
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Management <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $DB = new Database();
                        $where = array("typeUserId"=>$_SESSION['type']);
                        $pagesId = $DB->Select('pagesusers','',$where);
                        for($i=0;$i<count($pagesId);$i++)
                        {
                            $pageId = $pagesId[$i]['pagesId'];
                            $where = array("id"=>$pageId,' and '."state"=>1);
                            $page  = $DB->Select('pages','',$where);
                            if(!empty($page))
                                echo "<li><a href='?page={$page[0]['url']}'>{$page[0]['name']}</a></li>";                             
                        }
                        ?>
                    </ul>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                    if(!isset($_SESSION['username']))
                    {
                     ?>
                    <li <?php if (@($_GET['page']) == 'Register') echo "class='active'";?>><a href="?page=register">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'];?>
                            <img src="<?php echo $_SESSION['photo'];?>" height="20px" width="20px;">    
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="?page=editProfile">Edit Profile</a></li>
                      <li><a href="?page=message    ">Messages</a></li>
                      <li><a href="logout.php">Logout</a></li>
                    </ul>
                    </li>
                    <?php
                    }
                    ?>
                  
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <div class="moves">
            <div class="row">
                <div class="col-md-6">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">                        
                        <div class="carousel-inner" role="listbox">
                          <?php 
                        $where = array("state"=>1);
                        $slider = $DB->Select('slider','',$where);
                        for($i=0;$i<count($slider);$i++)
                        {
                            $photo = str_replace('../','',$slider[$i]['slider']);
                            if($i == 0)
                            {
                                echo 
                                          "<div class='item active'>
                                              <img src='$photo' style='width:100%;height:300px'class='img-responsive'>
                                              <div class='carousel-caption'>
                                              </div>
                                          </div>";
                            }
                            else
                            {
                                echo 
                                          "<div class='item'>
                                              <img src='$photo' style='width:100%;height:300px'class='img-responsive'>
                                              <div class='carousel-caption'>
                                              </div>
                                          </div>";
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="lead">
                        <?php echo $about[0]['aboutUs'];?>
                    </p>
                    <div class="icons">
                        <p class="lead">Accounts in Social Media </p>
                        <div class="socialmedia">             
                        <a target="_blank" href="<?php echo "{$about[0]['facebook']}";?>" class="hvr-bob"><i class="fa fa-facebook fa-lg"></i></a>
                        <a target="_blank" href="<?php echo "{$about[0]['twitter']}";?>" class="hvr-bob"><i class="fa fa-twitter fa-lg"></i></a>
                        <a target="_blank" href="<?php echo "{$about[0]['instagram']}";?>" class="hvr-bob"><i class="fa fa-instagram fa-lg"></i></i></a>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>