
<?php
include('dbcon.php');

$id = $_POST['id'];
$date = $_POST['date'];
$nop = $_POST['nop'];
$status= "Complete"; //CHANGE THIS AFTER REVISE
$values= $_POST['values'];
$commander = "python --version";
$outputser = exec($commander);

echo "<script>console.log('$values')</script>";

$command = escapeshellcmd("python app.py $values");
if ($values == "1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1"){
    $output = "Unknown disease please go to the clinic for more information";
}else if($values == "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0"){
    $output = "Unknown disease please go to the clinic for more information";
}else{
    $output = exec($command);
}
if($output == "['Canine Parvovirus']"){
    $output= "Canine Parvovirus";
}else if($output == "['Canine infectious respiratory disease']"){
    $output= "Canine infectious respiratory disease";
}else if($output == "['Blood parasite']"){
    $output= "Blood parasite";
}else if($output == "['Rabies']"){
    $output= "Rabies";
}else if($output == "['Canine Distemper']"){
    $output= "Canine Distemper";
}else if($output == "['Canine Distemper']"){
    $output= "Canine Distemper";
}else if($output == "['Leptospirosis']"){
    $output= "Leptospirosis";
}else if($output == "['Common Cold']"){
    $output= "Common Cold";
}else if($output == "['Gastroenteritis']"){
    $output= "Gastroenteritis";
}else if($output == "['Kennel Cough']"){
    $output= "Kennel Cough";
}



date_default_timezone_set('Asia/Manila');

$current_datetime = new DateTime();

// Format the date as a string (MM/DD/YY)
$month = $current_datetime->format('m');
$day = $current_datetime->format('d');
$year = substr($current_datetime->format('Y'), -2);
$formatted_date = $month . "/" . $day . "/" . $year;

// Format the time as a string in 12-hour format with AM/PM
$hours = $current_datetime->format('h');
$minutes = $current_datetime->format('i');
$am_pm = strtoupper($current_datetime->format('a')); // Convert to uppercase
$formatted_time = $hours . ":" . $minutes . " " . $am_pm;

// Combine the formatted date and time into a single string
$formatted_datetime = $formatted_date . " " . $formatted_time;



// Get a reference to the location where you want to update data
$reference = $database->getReference("Analytics/$id");
$petid = $reference->getChild('pet_id')->getValue(); 

// Define the new data
$newData = array(
    "diag" => $output,
	"status" => $status,
	"date_released"=> $formatted_datetime,
);

// Update the data at the reference location
$reference->update($newData);

//PHOTO URL REFERENCE

$photorefdata = $database->getReference("Pets/$petid");

$photoUrl = $photorefdata->getChild('photoUrl')->getValue(); 
$petname = $photorefdata->getChild('pname')->getValue();
$petowner_id = $photorefdata->getChild('ownerid')->getValue();  
//

$notfiRef = $database->getReference('Notifications');

$newNotifRef = $notfiRef->push();

$notifid = "N" . $newNotifRef->getKey();

date_default_timezone_set('Asia/Manila');

$notifdate = date("M d, Y \a\\t h:i A");

$notif= "Your pet symptom's evaluation results for " . $petname . " is now available. Please contact us to schedule an appointment for further examination and treatment. Thank you";

$datanotif = [
    'notif' => $notif,
    'notifid' => $notifid,
    'petid'=> $petid,
    'petname'=> $petname,
    'petowner_id' => $petowner_id,
    'notype' => "resultRep",
    'timestamp' => time(),
    'status' => "sent",
    'isOpen' => "No",
    'photo' => $photoUrl,
    'date' => $notifdate
];

$refer = "Notifications/$notifid";
$postdatanotif = $database->getReference($refer)->set($datanotif);




?>

<table class="table">                                                
					 <tr>
			 		 <th width="40%" class="text-left">Id :</th>
					 <td><?= $id ?></td>
					 </tr>
                     <tr>
					 <th width="40%" class="text-left">Date: </th>
					 <td><?= $date ?></td>
					 </tr>
					 <tr>
					 <th width="40%" class="text-left">Name: </th>
					 <td><?= $nop ?></td>
					 </tr>
					 <tr>
					 <th width="40%" class="text-left">Status: </th>
					 <td><?= $status ?></td>
					 </tr>

                     <tr>
					 <th width="40%" class="text-left">Pre-diagnosis: </th>
					 <td ><?= $output ?></td>
					 </tr>
                    
                     <tr>
					
                     
			
			 </table>


