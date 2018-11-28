<?php
require_once 'database.php';
require_once 'personclass.php';
class dentistClass extends personClass{

    public function __construct()
    {
        $DB = new Database();
        $DB->Connect();
    }



    public function approveRequest(bookingClass $booking)
    {
        $DB = new Database();
        $DB->Activation($booking->bookingId,$booking->state,'booking');
       
        $where = array(id=>$booking->bookingId);
        $patientId = $DB->Select('booking','',$where);
        $where = array(id=>$patientId[0]['appointmentId']);
        $dataDetails = $DB->Select('appointment','',$where);
        $where = array(id=>$dataDetails[0]['doctorId']);
        $doctor = $DB->Select('users','',$where);
      

        $Data['receiverId'] = $patientId[0]['patientId'];
        $Data['senderId']   = $_SESSION['id'];
     
         $message = "Your Appointment { "."Day : ".
      
         $dataDetails[0]['dayTime']." From : ".$dataDetails[0]['startTime']." To : ".$dataDetails[0]['endTime'].
        " With Dr : ".$doctor[0]['fullname']." }";
        $Data['message'] = $message;
        $check = $DB->Add('message',$Data);
        if($check)
            return true;
    }




    public function deleteRequest(bookingClass $booking)
    {
        $DB = new Database();
        $check = $DB->Delete('booking',$booking->bookingId);
        if($check)
            return true;
    }




    public function writePrescription(prescriptionClass $prescription)
    {
        $Data['prescription'] = $prescription->perscription;
        $Data['patientId']    = $prescription->patientId;
        $Data['doctorId']     = $prescription->doctorId;
        $DB = new Database();
        $check = $DB->Add('prescription',$Data);
        if($check)
            $DB->Delete ('booking',$prescription->patientId,'patientId');
            
    }





    public function addAppointment(appointmentClass $appointment)
    {
        $Data['dayTime']    = $appointment->dayTime;
        $Data['startTime']  = $appointment->startTime;
        $Data['endTime']    = $appointment->endTime;
        $Data['state']      = $appointment->state;
        $Data['doctorId']   = $appointment->doctorId;
        $DB = new Database();
        $check = $DB->Add('appointment',$Data);
        if($check)
            return true;
    }




    public function deleteAppointment(appointmentClass $appointment)
    {
        $DB = new Database();
        $check1 = $DB->Delete('reservation',$appointment->appointmentId,'appointmentId');
        $check2 = $DB->Delete('appointment',$appointment->appointmentId);
        if($check1 && $check2)
            return true;
    }






    public function stateAppointment(appointmentClass $appointment)
    {
        $DB = new Database();
        $check = $DB->Activation($appointment->appointmentId,$appointment->state,'appointment');
        if($check)
            return true;
    }
}
