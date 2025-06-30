<?php 
include('dbcon.php');

$apt_id = $_POST['apt_id'];
$apt_date = $_POST['apt_date'];
$apt_time = $_POST['apt_time'];
$apt_type = $_POST['apt_type'];
$apt_desc = $_POST['apt_desc'];
$apt_stat = $_POST['apt_stat'];

$pet_id = $_POST['pet_id'];
$pet_name = $_POST['pet_name'];
$petowner = $_POST['petowner'];
$petowner_id = $_POST['petowner_id'];

$data = [
    'apt_id' => $apt_id,
    'apt_date' => $apt_date,
    'apt_time' => $apt_time,
    'apt_type' => $apt_type,
    'apt_desc' => $apt_desc,
    'apt_stat' => $apt_stat, 
    'pet_id' => $pet_id,
    'pet_name' => $pet_name,
    'petowner' => $petowner,
    'petowner_id' => $petowner_id,
];



$ref = "Appointments/$apt_id";

$postdata = $database->getReference($ref)->update($data);


//PHOTO URL REFERENCE

$photorefdata = $database->getReference("Pets/$pet_id");

$photoUrl = $photorefdata->getChild('photoUrl')->getValue(); 

$petname = $photorefdata->getChild('pname')->getValue(); 
//
$notfiRef = $database->getReference('Notifications');

$newNotifRef = $notfiRef->push();

$notifid = "N" . $newNotifRef->getKey();

date_default_timezone_set('Asia/Manila');

$notifdate = date("M d, Y \a\\t h:i A");

$notif= "Your appointment for " . $pet_name . " has been updated by the clinic, the new appointment schedule is " . $apt_date. " at " . $apt_time;

$datanotif = [
    'notif'=> $notif,
    'apt_date'=> $apt_date,
    'apt_time'=> $apt_time,
    'notifid' => $notifid,
    'petname' => $petname,
    'petowner_id' => $petowner_id,
    'petid' => $pet_id,
    'timestamp' => time(),
    'notype'=> "editApt",
    'status' => "sent",
    'isOpen' => "No",
    'photo' => $photoUrl,
    'date' => $notifdate
];

$refer = "Notifications/$notifid";
$postdatanotif = $database->getReference($refer)->set($datanotif);


?>