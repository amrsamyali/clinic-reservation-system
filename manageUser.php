<section class="options">
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#patient" aria-controls="home" role="tab" data-toggle="tab">Patients</a></li>
           <li role="presentation"><a href="#doctor" aria-controls="home" role="tab" data-toggle="tab">Doctors</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="patient" style="margin-top: 10px;"> 
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      $where = array("type"=>3);
                      $users =$DB->Select('users','',$where);
                      for($i=0;$i<count($users);$i++)
                      {
                          echo "<tr>
                               <td>{$users[$i]['fullname']}</td>
                               <td>{$users[$i]['email']}</td>
                               <td>{$users[$i]['telephone']}</td>
                               <td>{$users[$i]['username']}</td>
                               <td>{$users[$i]['password']}</td>
                               ";
                               echo "<td><a href='?page=adminController&actionUser=delete&id={$users[$i]['id']}' style='margin-right:10px'><i class='fa fa-trash-o turn-off'></i></a>";
                               if($users[$i]['state'] == 1)
                               {
                                   echo "<a href='?page=adminController&actionUser=active&id={$users[$i]['id']}&state={$users[$i]['state']}' class='state' style='background:#57e757'>Active Now</a>";
                               }
                               else
                               {
                                   echo "<a href='?page=adminController&actionUser=active&id={$users[$i]['id']}&state={$users[$i]['state']}' class='state' style='background:#ff3f00'>Not Active</a>";
                               }
                               
                               echo "
                               </td>
                               </tr>
                               ";
                      }
                      ?>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="doctor" style="margin-top: 10px;"> 
                <section class="options">
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#doctor" aria-controls="home" role="tab" data-toggle="tab">Doctors</a></li>
          <li role="presentation"><a href="#new" aria-controls="profile" role="tab" data-toggle="tab">New Doctor</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="doctor" style="margin-top: 10px;">    
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      $where = array("type"=>2);
                      $users =$DB->Select('users','',$where);
                      for($i=0;$i<count($users);$i++)
                      {
                          echo "<tr>
                               <td>{$users[$i]['fullname']}</td>
                               <td>{$users[$i]['email']}</td>
                               <td>{$users[$i]['telephone']}</td>
                               <td>{$users[$i]['username']}</td>
                               <td>{$users[$i]['password']}</td>
                               ";
                               echo "<td><a href='?page=adminController&actionUser=delete&id={$users[$i]['id']}' style='margin-right:10px'><i class='fa fa-trash-o turn-off'></i></a>";
                               if($users[$i]['state'] == 1)
                               {
                                   echo "<a href='?page=adminController&actionUser=active&id={$users[$i]['id']}&state={$users[$i]['state']}' class='state' style='background:#57e757'>Active Now</a>";
                               }
                               else
                               {
                                   echo "<a href='?page=adminController&actionUser=active&id={$users[$i]['id']}&state={$users[$i]['state']}' class='state' style='background:#ff3f00'>Not Active</a>";
                               }
                               echo "
                               </td>
                               </tr>
                               ";
                      }
                      ?>
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="new">
                <h6>Register</h6>
                <form class="register" name="myForm" action="adminController.php" method="post" enctype="multipart/form-data">
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
            </div>
      </div>
</section>
            </div>
      </div>
</section>


