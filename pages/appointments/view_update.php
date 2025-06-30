<?php

$petid = $_POST['petid'];
$pname = $_POST['pname'];
$gender = $_POST['gender'];
$breed = $_POST['breed'];
$weight = $_POST['weight'];
$ownername = $_POST['ownername'];
$id = $_POST['id'];

?>


<div class="row" >
<div class="card card-primary card-outline" style="margin-left:35px;margin-right:35px; width: 500px;" >
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/dog.PNG"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $pname ?></h3>

                <p class="text-muted text-center">Pet ID: <?= $petid ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Breed:</b> <a class="float-right"><?= $breed ?></a>
                    
                  </li>
                  <li class="list-group-item">
                    <b>Gender:</b> <a class="float-right"><?= $gender ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Weight:</b> <a class="float-right"><?= $weight ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Owner name:</b> <a class="float-right"><?= $ownername ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div> 
          </div>