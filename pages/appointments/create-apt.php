<?php

include('dbcon.php');

$petid = $_POST['petid'];
$pname = $_POST['pname'];
$gender = $_POST['gender'];
$breed = $_POST['breed'];
$weight = $_POST['weight'];
$ownername = $_POST['ownername'];
$id = $_POST['id'];

// Initialize Firebase reference


// Sort array based on id field in descending order

 
$refer = $database->getReference("Pets/$petid");

$photoUrl = $refer->getChild('photoUrl')->getValue();



?>
<div class="row" >
<div class="card card-primary card-outline" style="margin-left:35px;margin-right:35px; width: 500px;" >
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src=<?php echo $photoUrl ?>
                       alt="User profile picture" style="object-fit:cover; height:140px;width:140px;">
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

            <input type="hidden" name="setpetid" id="setpetid" class="form-control" value="<?= $petid ?>">
            <input type="hidden" name="setpname" id="setpname" class="form-control" value="<?= $pname ?>">
            <input type="hidden" name="setbreed" id="setbreed" class="form-control" value="<?= $breed ?>">
            <input type="hidden" name="setgender" id="setgender" class="form-control" value="<?= $gender ?>">
            <input type="hidden" name="setweight" id="setweight" class="form-control" value="<?= $weight ?>">
            <input type="hidden" name="setownername" id="setownername" class="form-control" value="<?= $ownername ?>">
            <input type="hidden" name="setid" id="setid" class="form-control"  value="<?= $id ?>">

    <div class="card" style="margin-left:50px; width: 500px;" >       
        <div class="card-body">
            <label for="apt_type">Type of Appointment</label>
            <select name="apt_type" id="setapttype" class="form-control"  required>
                                                            <option value="">--- Select type of appointment---</option>
                                                            <option value="Check-up">Check-up</option>
                                                            <option value="Surgery">Surgery</option>
                                                            <option value="Vaccination">Vaccination</option>
                                                            <option value="Grooming">Grooming</option>
                                                            <option value="Deworming">Deworming</option>
                                                        </select>

            <label for="apt_desc">Description</label>
                        <textarea class="form-control" id ="setaptdesc" rows="3" placeholder="Enter description of appointment...."></textarea>
           <!-- Date -->
           <div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="setaptdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#setaptdate" id="setaptdates"/>
                        <div class="input-group-append" data-target="#setaptdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
          
       
                    <label for="setapttimes">Set Time:</label>
                    <select class="form-control" style="background-color: #F1F5FF; margin-top: -5px; " id="setapttimes" required>                       
                        <option selected disabled value="">--- Set time---</option>
                        <option value="9:00 AM to 9:30 AM">9:00 AM to 9:30 AM</option>
                        <option value="9:30 AM to 10:00 AM">9:30 AM to 10:00 AM</option>
                        <option value="10:00 AM to 10:30 AM">10:00 AM to 10:30 AM</option>
                        <option value="10:30 AM to 11:00 AM">10:30 AM to 11:00 AM</option>
                        <option value="11:00 AM to 11:30 AM">11:00 AM to 11:30 AM</option>
                        <option value="11:30 AM to 12:00 PM">11:30 AM to 12:00 PM</option>
                        <option value="12:00 PM to 12:30 PM">12:00 PM to 12:30 PM</option>
                        <option value="12:30 PM to 1:00 PM">12:30 PM to 1:00 PM</option>
                        <option value="1:00 PM to 1:30 PM">1:00 PM to 1:30 PM</option>
                        <option value="1:30 PM to 2:00 PM">1:30 PM to 2:00 PM</option>
                        <option value="2:00 PM to 2:30 PM">2:00 PM to 2:30 PM</option>
                        <option value="2:30 PM to 3:00 PM">2:30 PM to 3:00 PM</option>
                        <option value="3:00 PM to 3:30 PM">3:00 PM to 3:30 PM</option>
                        <option value="3:30 PM to 4:00 PM">3:30 PM to 4:00 PM</option>
                        <option value="4:00 PM to 4:30 PM">4:00 PM to 4:30 PM</option>
                        <option value="4:30 PM to 5:00 PM">4:30 PM to 5:00 PM</option>
                        <option value="5:00 PM to 5:30 PM">5:00 PM to 5:30 PM</option>
                        <option value="5:30 PM to 6:00 PM">5:30 PM to 6:00 PM</option>
                      </select>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
          
     </div>
</div>
<script>
    //Timepicker
 

    $(function () {

  var timeOptions = $('#setapttimes option'); // get all time options
  $('#setaptdate').datetimepicker({
    format: 'L',
    minDate: new Date()
  });

  $('#setaptdate').on('change.datetimepicker', function (e) {
    var selectedDate = e.date;
    var formattedDate = moment(selectedDate).format('YYYY-MM-DD');
    var formattedDated = moment(selectedDate).format("MM/DD/YYYY");
    var currentTime = new Date();

    timeOptions.each(function() {
      $(this).removeAttr('disabled');
      var optionTime = $(this).val().split(' to ')[0];
  
      var optionDate = new Date(formattedDate + ' ' + optionTime);
      if (optionDate < currentTime) {
      $(this).hide(); // hide the option that has already passed
    } else {
      $(this).show(); // show the option that is still available
    }
    });

    var myTime = database.ref('Appointments');

myTime.once('value').then(function(snapshot) {
  // reset all time options to available
  timeOptions.each(function() {
    $(this).removeAttr('disabled');
    $(this).text($(this).text().replace(' - Unavailable', ''));
  });

  snapshot.forEach(function(childSnapshot) {
    var date = childSnapshot.val().apt_date;
    var time = childSnapshot.val().apt_time;

    // loop through each option in the select dropdown
    timeOptions.each(function() {
      if (formattedDated == date && $(this).val() == time) { // if the time is already taken
        $(this).attr('disabled', true); // set the option as disabled
        $(this).text($(this).text() + ' - Unavailable'); // add the word "Unavailable" to the option text
      } else {
        console.log("not true");
      }
    });
  });
});
  });
});
</script>