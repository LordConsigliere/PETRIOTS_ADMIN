<?php

include('dbcon.php');

$fid = $_POST['fid'];


$ref = $database->getReference("Feedbacks/$fid");

$feedback = $ref->getChild('feedback')->getValue();

$fullname = $ref->getChild('full_name')->getValue();

$date = $ref->getChild('date')->getValue();

$msg = $ref->getChild('msg')->getValue();

$ownerid = $ref->getChild('ownerid')->getValue();


$refer= $database->getReference("PetOwners/$ownerid");


$photoUrl = $refer->getChild('photoUrl')->getValue();

if (!empty($photoUrl)) {
    $src = $photoUrl;
  } else {
    $src = "../../dist/img/user.png";
  }

?>
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src=<?= $src ?> alt="User Image"   style="border-radius: 50%; width: 40px; height: 40px; object-fit: cover; margin-right:10px">
                  <span class="username"><a href="#"><?= $fullname ?></a></span>
                  <span class="description">Date released: <?= $date ?></span>
                </div>
                <!-- /.user-block -->
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p><?= $msg ?></p>
                <span class="float-right text-muted">(<?= $feedback ?> stars) <?php 
                            // Determine the number of stars based on the feedback value
                            if ($feedback >= 5) {
                                $num_stars = 5;
                            } elseif ($feedback >= 4) {
                                $num_stars = 4;
                            } elseif ($feedback >= 3) {
                                $num_stars = 3;
                            } elseif ($feedback >= 2) {
                                $num_stars = 2;
                            } elseif ($feedback >= 1) {
                                $num_stars = 1;
                            } else {
                                $num_stars = 0;
                            }

                            // Output the HTML for the stars
                            echo '<div class="rate" style="float: right;margin-bottom: -30px;margin-top: -1px; pointer-events: none">';
                            for ($i = 5; $i >= 1; $i--) {
                                $checked = ($num_stars == $i) ? 'checked' : '';
                                echo '<input type="radio" id="star' . $i . '" name="rate" value="' . $i . '" disabled ' . $checked . '/>';
                                echo '<label for="star' . $i . '" title="text">' . $i . ' stars</label>';
                            }
                            echo '</div>'; ?> </span>
              </div>

            </div>
            <!-- /.card -->
