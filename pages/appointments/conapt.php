<?php 
include('dbcon.php');

$aptid = $_POST['conapt'];

// Get a reference to the location where you want to update data
$reference = $database->getReference("Appointments/$aptid");

// Define the new data
$newData = array(
    "apt_stat" => "Confirmed",
);

// Update the data at the reference location
$reference->update($newData);


$ref = $database->getReference("Appointments/$aptid");

$petowner_id = $ref->getChild('petowner_id')->getValue();

$petid = $ref->getChild('pet_id')->getValue(); 

$petname = $ref->getChild('pet_name')->getValue();

$aptdate = $ref->getChild('apt_time')->getValue();

$apttime = $ref->getChild('apt_date')->getValue();

$petid = $ref->getChild('pet_id')->getValue();


$petname = $ref->getChild('pet_name')->getValue();
//PHOTO URL REFERENCE

$photorefdata = $database->getReference("Pets/$petid");

$photoUrl = $photorefdata->getChild('photoUrl')->getValue(); 

//

$notfiRef = $database->getReference('Notifications');

$newNotifRef = $notfiRef->push();

$notifid = "N" . $newNotifRef->getKey();

date_default_timezone_set('Asia/Manila');

$notifdate = date("M d, Y \a\\t h:i A");

$notif= "Your appointment for " . $petname . " has been confirmed";

$datanotif = [
    'notif' => $notif,
    'notifid' => $notifid,
    'apt_date'=> $aptdate,
    'apt_time'=> $apttime,
    'petid'=> $petid,
    'petname'=> $petname,
    'petowner_id' => $petowner_id,
    'notype' => "conApt",
    'timestamp' => time(),
    'status' => "sent",
    'isOpen' => "No",
    'photo' => $photoUrl,
    'date' => $notifdate
];

$refer = "Notifications/$notifid";
$postdatanotif = $database->getReference($refer)->set($datanotif);


if($postdatanotif){

}else{

}


?>