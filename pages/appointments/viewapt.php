<?php

include('dbcon.php');

$apt_id = $_POST['apt_id'];

$ref = $database->getReference("Appointments/$apt_id");

$apt_time = $ref->getChild('apt_time')->getValue();

$apt_date = $ref->getChild('apt_date')->getValue();

$pet_id = $ref->getChild('pet_id')->getValue();

$apt_type = $ref->getChild('apt_type')->getValue();

$apt_stat = $ref->getChild('apt_stat')->getValue();

$reference = $database->getReference("Pets/$pet_id");


$pname = $reference->getChild('pname')->getValue();
$breed = $reference->getChild('breed')->getValue();
$photoUrl = $reference->getChild('photoUrl')->getValue();
$ownername = $ref->getChild('petowner')->getValue();
?>
<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src= <?= $photoUrl ?>
                       alt="User profile picture"  style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
                </div>

                <h3 class="profile-username text-center"><?= $pname ?></h3>

                <p class="text-muted text-center"><?= $breed ?></p>

                <strong><i class="fas fa-book mr-1"></i>Date of appointment</strong>

                        <p class="text-muted">
                       <?= $apt_date ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Time</strong>

                        <p class="text-muted"><?= $apt_time ?></p>


                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i>Type of appointment</strong>

                        <p class="text-muted"><?= $apt_type ?></p>
                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Ownername </strong>

                        <p class="text-muted"><?= $ownername ?></p>

                        <strong><i class="far fa-file-alt mr-1"></i> Status </strong>

                        <p class="text-muted"><?= $apt_stat ?></p>
              </div>