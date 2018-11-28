<section class="cast">
    <div class="container">
         <h2>Top Doctors</h2>
        <hr>
        <div class="row">
            <?php 
            require_once 'database.php';
            $DB = new Database();
            $where = array("type"=>2);
            $doctors = $DB->Select('users','',$where);
            for($i=0;$i<count($doctors);$i++)
            {
                if($i == 4)
                    break;
                echo "<div class='col-md-3 col-sm-6 dr'>
                      <img src='{$doctors[$i]['photo']}' class='img-responsive img-thumbnail'>
                      <p class='lead'>{$doctors[$i]['fullname']}</p>
                      </div>";
            }
            ?>
        </div>
    </div>
</section>