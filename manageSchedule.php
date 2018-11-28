<?php
include 'security.php';
require_once 'database.php';
require_once 'bookingClass.php';
require_once 'dentistClass.php';
require_once 'prescriptionClass.php';
$DB =new Database();
$dentist = new dentistClass();
$booking = new bookingClass();
$prescription = new prescriptionClass();
if(isset($_GET['action']) && $_GET['action'] == 'approve')
{
    $booking->bookingId = $_GET['id'];
    $booking->state     = $_GET['state'];
    $dentist->approveRequest($booking);
}
if(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $booking->bookingId = $_GET['id'];
    $dentist->deleteRequest($booking);
}
if(isset($_POST['send']) && $_POST['send'] == 'Send')
{
    $prescription->doctorId     = $_SESSION['id'];
    $prescription->patientId    = $_POST['patientId'];
    $prescription->perscription = $_POST['prescription'];
    $dentist->writePrescription($prescription);
    header("location:index.php");
}

?>

<ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#approves" aria-controls="home" role="tab" data-toggle="tab">Approves</a></li>
          <li role="presentation"><a href="#schedule" aria-controls="profile" role="tab" data-toggle="tab">Schedule</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="approves" style="margin-top: 10px;">  
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Approve</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      
                      $query = "select * from booking where state = 0 and appointmentId IN(select id from Appointment where doctorId={$_SESSION['id']})";
                      $booking = $DB->Select_Query($query);
                      for($i=0;$i<count($booking);$i++)
                      {
                          $userId = $booking[$i]['patientId'];
                          $where = array(id=>$userId);
                          $patient = $DB->Select('users','',$where);
                          $where = array(id=>$booking[$i]['appointmentId']);
                          $appointmentDetails = $DB->Select('appointment','',$where);
                          echo "<tr>
                               <td>{$patient[0]['fullname']}</td>
                               <td>{$appointmentDetails[0]['dayTime']} - {$appointmentDetails[0]['startTime']} : {$appointmentDetails[0]['endTime']}</td>
                               ";
                               echo "<td><a href='?page=manageSchedule&action=delete&id={$booking[$i]['id']}' style='margin-right:10px;'><i class='fa fa-trash-o turn-off'></i></a>";
                               echo "<a href='?page=manageSchedule&action=approve&id={$booking[$i]['id']}&state={$booking[$i]['state']}'><i class='fa fa-toggle-off turn-off'></i></a>";
                               echo "
                               </td>
                               </tr>
                               ";
                        }

                      ?>
                    </tbody>
                  </table>
            </div>
            <div role="tabpanel" class="tab-pane fade in " id="schedule" style="margin-top: 10px;">
                <table class="table table-striped appoint">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Prescription</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      require_once 'database.php';
                      $DB = new Database();
                      
                      $query = "select * from booking where state = 1 and appointmentId IN(select id from Appointment where doctorId={$_SESSION['id']})";
                      $booking = $DB->Select_Query($query);
                      for($i=0;$i<count($booking);$i++)
                      {
                          $userId = $booking[$i]['patientId'];
                          $where = array(id=>$userId);
                          $patient = $DB->Select('users','',$where);
                          $where = array(id=>$booking[$i]['appointmentId']);
                          $appointmentDetails = $DB->Select('appointment','',$where);
                          echo "<tr>
                               <td>{$patient[0]['fullname']}</td>
                               <td>{$appointmentDetails[0]['dayTime']} - {$appointmentDetails[0]['startTime']} : {$appointmentDetails[0]['endTime']}</td>
                               ";
                              // echo "<td><a href='?page=manageSchedule&action=write&patientId={$userId}'><i class='fa fa fa-file-o turn-off'></i></a></td>";
                               ?>
                    <td><button type="button" value="<?php echo $userId;?>" style="background: none; border:0;" data-toggle="modal" data-target="#<?php echo $i;?>"><i class='fa fa fa-file-o turn-off'></i></button></td>
                            <!-- Modal -->
                            <div id="<?php echo $i;?>" class="modal fade" role="dialog" style="overflow: hidden;">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Prescription For <?php echo $patient[0]['fullname'];?></h4>
                                  </div>
                                  <div class="modal-body">
                                      <form action="manageSchedule.php" method="post">
                                          <input type="hidden" name="patientId" value="<?php echo $patient[0]['id'];?>">
                                          <textarea name="prescription" class="form-control" placeholder="Write Prescription..."></textarea>
                                          <br>
                                          <button type="submit" name="send" value="Send" class="btn btn-success">Send</button>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </form>
                                  </div>
                                </div>

                              </div>
                            </div>
                             <?php
                          echo "</tr>";
                        }

                      ?>
                    </tbody>
                  </table>
            </div>
        </div>