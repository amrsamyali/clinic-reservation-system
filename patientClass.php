<?php
require_once 'database.php';
require_once 'personClass.php';
class patientClass extends personClass{

    public function __construct() {
        $DB = new Database();
        $DB->Connect();
    }
    public function register()
    {
        $Data['email']     = $this->email;
        $Data['fullname']  = $this->fullname;
        $Data['gender']    = $this->gender;
        $Data['telephone'] = $this->telephone;
        $Data['state']     = $this->state;
        $Data['type']      = $this->type;
        $Data['username']  = $this->username;
        $Data['password']  = $this->password;
        $Data['photo']     = $this->photo;
        $DB = new Database();
        $check = $DB->Add('users',$Data);
        if($check)
            return TRUE;  
    }
    public function requestBooking(bookingClass $booking)
    {
        $DB = new Database();
        $Data['state']         = $booking->state;
        $Data['appointmentId'] = $booking->appointmentId;
        $Data['patientId']     = $booking->patientId;
        $check = $DB->Add('booking',$Data);
        if($check)
            return true;
    }
    public function cancelBooking(bookingClass $booking)
    {
        $DB = new Database();
        $check = $DB->Delete('booking',$booking->bookingId);
        if($check)
            return true;
    }
}