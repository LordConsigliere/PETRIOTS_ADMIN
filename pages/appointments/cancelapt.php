<?php 
include('dbcon.php');

$aptid = $_POST['apt_id'];


$ref = $database->getReference("Appointments/$aptid");

$name = $ref->getChild('pet_name')->getValue();
?>


<p style="font-size:16px;font-weight:500px;"> Are you sure you want to cancel the appointment of  <?= $name  ?>?</p>

<input type="hidden" id="cancelapt" class="form-control"
            name="cancelapt"  value="<?= $aptid ?>" hidden>
<?php


?>