<?php  
include('dbcon.php');

  

$apt_stat = $_POST['setaptstat'];
$apt_pet_id = $_POST['petid'];
$apt_petname = $_POST['setpetname'];
$apt_date = $_POST['setaptdate'];
$apt_time = $_POST['setapttime'];
$pet_owner = $_POST['setpetowner'];
$apt_type = $_POST['setapttype'];
$petowner_id = $_POST['setownnerid'];
$apt_desc = $_POST['setaptdesc'];

//NOTIFICATION 

$message = "You have a new appointment for " . $apt_petname . " at " . $apt_date ." ".$apt_time;

$appointmentsRef = $database->getReference('Appointments');

$newAppointmentRef = $appointmentsRef->push();

$aptid = "APT" . $newAppointmentRef->getKey();


$data = [
    'apt_id' => $aptid,
    'pet_id' => $apt_pet_id,
    'pet_name' => $apt_petname,
    'apt_date' => $apt_date,
    'apt_time' => $apt_time,
    'apt_type' => $apt_type,
    'apt_desc' => $apt_desc,
    'petowner_id' => $petowner_id,
    'petowner' => $pet_owner,
    'apt_stat' => $apt_stat
];


$ref = "Appointments/$aptid";

$postdata = $database->getReference($ref)->set($data);


$photorefdata = $database->getReference("Pets/$apt_pet_id");

$photoUrl = $photorefdata->getChild('photoUrl')->getValue(); 
//NOTIFICATIONS
$notfiRef = $database->getReference('Notifications');

$newNotifRef = $notfiRef->push();

$notifid = "N" . $newNotifRef->getKey();

date_default_timezone_set('Asia/Manila');

$notifdate = date("M d, Y \a\\t h:i A");

$notif = "You have new appointment for ". $apt_petname  . " at " .  $apt_time . " on "  .  $apt_date ;
$datanotif = [
    'notif'=> $notif,
    'notype'=> "createApt",
    'petid' => $apt_pet_id,
    'petname' => $apt_petname,
    'apt_date' => $apt_date,
    'apt_time' => $apt_time,
    'notifid' => $notifid,
    'petowner_id' => $petowner_id,
    'timestamp' => time(),
    'status' => "sent",
    'isOpen' => "No",
    'date' => $notifdate,
    'photo' => $photoUrl
    
];

$refer = "Notifications/$notifid";
$postdatanotif = $database->getReference($refer)->set($datanotif);


if($postdatanotif){

}else{

}


if($postdata){

}else{

}


?>   
