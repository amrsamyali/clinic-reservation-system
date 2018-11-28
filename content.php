<section class="content">
    
                <?php
                if(isset($_GET['page']))
                {
                    $page = $_GET['page'].'.php';
                    if($_GET['page'] == "register" || "cast" || "contact")
                    {
                        echo "<div class='container'>";
                        include $page;
                        echo "</div>";
                    }
                    else if(is_file($page))
                    {
                        require_once 'database.php';
                        $DB = new Database();
                        $where = array(url=>$_GET['page']);
                        $pageId=$DB->Select('pages','',$where);
                        $id=$pageId[0]['id'];
                        $where=array(typeUserId=>$_SESSION['type'],' and '.pagesId=>$id);
                        $checkArray = $DB->Select('pagesusers','',$where);
                        if(empty($checkArray))
                        {
                            echo "";
                            echo "<h2 style='color:red;text-align:center;'><i class='fa fa-frown-o fa-3x'></i>"
                            . "<br>Page Not Allowed For You ...</h2>";    
                        }
                        else
                        {
                        echo "<div class='container'>";
                        include $page; 
                        echo '</div>';
                        }
                    }
                    else
                    {
                    echo '<h2>Page Not Available Now</h2>';
                    echo $page;
                    }
                }
                else
                {
                    include 'cast.php';
                    include 'contact.php';
                    
                }
                ?>
</section>
