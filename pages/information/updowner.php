<?php
include('dbcon.php');

$ownerid = $_POST['ownerid'];


$ref = $database->getReference("PetOwners/$ownerid");

$firstname = $ref->getChild('firstName')->getValue();

$lastname = $ref->getChild('lastName')->getValue();

$sex = $ref->getChild('sex')->getValue();

$email = $ref->getChild('email')->getValue();

$pnum = $ref->getChild('pnum')->getValue();

$address = $ref->getChild('address')->getValue();

$photoUrl = $ref->getChild('photoUrl')->getValue();

$ref = $database->getReference("Pets");

$query = $ref->orderByChild("ownerid")->equalTo($ownerid);

$snapshot = $query->getSnapshot();

$count = $snapshot->numChildren();

$data = $snapshot->getValue();


if (!empty($photoUrl)) {
    $src = $photoUrl;
  } else {
    $src = "../../dist/img/user.png";
  }
?>
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user" >
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-black"
                   style="background: url('../../dist/img/cphoto.jpg') center center;">
                <h3 class="widget-user-username text-right" style="font-weight:700;"><?= $firstname?> <?= $lastname?> </h3>
                <h5 class="widget-user-desc text-right">Pet Owner</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src=<?= $src ?>  alt="User Avatar"  style="border-radius: 50%; width: 110px; height: 110px; object-fit: cover;">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?= $sex ?></h5>
                      <span class="description-text">Sex</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?= $email ?> </h5>
                      <span class="description-text">Email</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?= $pnum ?></h5>
                      <span class="description-text">Phone number</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->        
            <div class="card card-primary card-outline" >
              <div class="card-body box-profile">
        

                <ul class="list-group list-group-unbordered mb-3">
    
                <li class="list-group-item">
                    <b>Address:</b> <a class="float-right"><?= $address ?></a>
                    
                  </li>
                <li class="list-group-item">
                    <b>Number of Pets:</b> <a class="float-right"> <?= $count ?></a>
                    
                  </li>
                  <li class="list-group-item">
                    <b>Pet Names:</b> <a class="float-right"> <?php foreach ($data as $key => $value) {
    $pname = $value['pname'];
    echo " $pname, ";
} ?></a>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-body -->
            </div>