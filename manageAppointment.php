<?php 
include 'security.php';
require_once 'database.php';
require_once 'appointmentClass.php';
require_once 'dentistClass.php';
$DB          = new Database();
$appointment = new appointmentClass();
$dentist     = new dentistClass();
if(isset($_POST) && $_POST['save'] == 'save')
{
    $appointment->dayTime   = $_POST['dayTime'];
    $appointment->endTime   = $_POST['endTime'];
    $appointment->startTime = $_POST['startTime'];
    $appointment->doctorId  = $_SESSION['id'];
    $appointment->state     = 0;
    $check = $dentist->addAppointment($appointment);
    if($check == true)
        header ('location:index.php?page=manageAppointment');
}
if(isset($_GET['action']) && $_GET['action'] == 'turn')
{
    $appointment->appointmentId = $_GET['id'];
    $appointment->state         = $_GET['state'];
    $dentist->stateAppointment($appointment);
}
if(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $appointment->appointmentId = $_GET['id'];
    $dentist->deleteAppointment($appointment);
}

?>

<ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#appointment" aria-controls="home" role="tab" data-toggle="tab">Appointments</a></li>
          <li role="presentation"><a href="#new" aria-controls="profile" role="tab" data-toggle="tab">New Appointment</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="appointment" style="margin-top: 10px;">  
            <table class="table table-striped appoint">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Process</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  require_once 'database.php';
                  $DB = new Database();
                  $where = array(doctorId=>$_SESSION['id']);
                  $appointments =$DB->Select('appointment','',$where);
                  for($i=0;$i<count($appointments);$i++)
                  {
                      echo "<tr>
                           <td>{$appointments[$i]['id']}</td>
                           <td>{$appointments[0]['dayTime']}</td>
                           <td>{$appointments[0]['startTime']}</td>
                           <td>{$appointments[0]['endTime']}</td>
                           <td>
                           <a href='?page=manageAppointment&action=delete&id={$appointments[$i]['id']}'><i class='fa fa-trash delete'></i></a>
                           ";
                           if($appointments[$i]['state'] == '0')
                           {
                           echo "<a href='?page=manageAppointment&action=turn&id={$appointments[$i]['id']}&state={$appointments[$i]['state']}'><i class='fa fa-toggle-off turn-off'></i></a>";
                           }
                           else
                           {
                           echo "<a href='?page=manageAppointment&action=turn&id={$appointments[$i]['id']}&state={$appointments[$i]['state']}'><i class='fa fa-toggle-on turn-on'></i></a>";
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
            <div role="tabpanel" class="tab-pane fade in" id="new" style="margin-top: 10px;">  
                <form class="form" method="post" action="manageAppointment.php">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Day</label>
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0"name="dayTime" required style="display: block;margin-bottom: 10px;">
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">Time Start : </label>
                      <input type="text" class="input-group" name="startTime" placeholder="00:00" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect">Time End :</label>
                      <input type="text" class="input-group" name="endTime" placeholder="00:00"autocomplete="off">
                    </div>
                    <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
                </form>
            </div>

