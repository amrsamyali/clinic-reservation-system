<?php 
include 'security.php';
require_once'database.php';
require_once 'patientClass.php';
require_once 'bookingClass.php';
$DB      = new Database();
$patient = new patientClass();
$booking = new bookingClass();
if(isset($_POST) && $_POST['reverse'] == 'reverse')
    {
        $booking->patientId = $_SESSION['id'];
        $booking->appointmentId = $_POST['appointment'];
        $booking->state     = 0;
        $check = $patient->requestBooking($booking);
            if($check == TRUE)
                header ("location:index.php?page=manageReservation");
    }
  
if(isset($_GET) && $_GET['action'] == 'delete')
  {
      $booking->bookingId = $_GET['id'];
      $patient->cancelBooking($booking);
  }
?>
<section class="options">
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#reservation" aria-controls="home" role="tab" data-toggle="tab">Reservation</a></li>
          <li role="presentation"><a href="#new" aria-controls="profile" role="tab" data-toggle="tab">New Reservation</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="reservation" style="margin-top: 10px;">    
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>Day</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Doctor</th>
                        <th>Cancel</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      $where = array(patientId=>$_SESSION['id'],' and '.state=>0);
                      $bookingId =$DB->Select('booking','',$where);
                      $where = array(id=>$bookingId[0]['appointmentId']);
                      $appointments =$DB->Select('appointment','',$where);
                      for($i=0;$i<count($appointments);$i++)
                      {
                          $where = array(id=>$appointments[$i]['doctorId']);
                          $doctor = $DB->Select('users','',$where);


                          echo "<tr>
                               <td>{$appointments[0]['dayTime']}</td>
                               <td>{$appointments[0]['startTime']}</td>
                               <td>{$appointments[0]['endTime']}</td>
                               <td>{$doctor[0]['fullname']}</td>
                               <td>
                               <a href='?page=manageReservation&action=delete&id={$bookingId[0]['id']}'><i class='fa fa-trash delete'></i></a>
                               ";
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
                <?php
                $where = array(patientId=>$_SESSION['id']);
                $bookingId =$DB->Select('booking','',$where);
                if(empty($bookingId))
                {
                    ?>
                <form class="form" method="post" action="manageReservation.php">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Choose</th>
                          <th>Day</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Doctor</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        require_once 'database.php';
                        $DB = new Database();
                        $where = array(state=>'1');
                        $appointments =$DB->Select('appointment','',$where);
                        for($i=0;$i<count($appointments);$i++)
                        {
                            $where = array(id=>$appointments[$i]['doctorId']);
                            $doctor = $DB->Select('users','',$where);
                            echo "<tr>
                                 <td><input type='radio' name='appointment' value='{$appointments[$i]['id']}'></td>
                                 <td>{$appointments[0]['dayTime']}</td>
                                 <td>{$appointments[0]['startTime']}</td>
                                 <td>{$appointments[0]['endTime']}</td>
                                 <td>{$doctor[0]['fullname']}</td>    
                                 </tr>
                                 ";
                        }
                        ?>
                      </tbody>
                    </table>  
                      <button type="reset" value="reset" class="btn btn-danger">Reset</button>  
                    <button type="submit" name="reverse" value="reverse" class="btn btn-primary">Reverse</button>
                  </form>
                <?php
                }
                else
                {
                    echo "<p class='lead' style='color:red;'>You Can't Reserve Appointment Because You Already Have One</p>";
                }
                ?>
            </div>
      </div>
</section>