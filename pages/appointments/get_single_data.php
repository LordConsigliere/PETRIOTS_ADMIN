<?php
include('dbcon.php');

$apt_id = $_POST['apt_id'];

$ref = $database->getReference("Appointments/$apt_id");

$apt_time = $ref->getChild('apt_time')->getValue();

$apt_date = $ref->getChild('apt_date')->getValue();

$apt_type = $ref->getChild('apt_type')->getValue();

$apt_desc = $ref->getChild('apt_desc')->getValue();

$pet_id = $ref->getChild('pet_id')->getValue();

$petowner_id = $ref->getChild('petowner_id')->getValue();

$apt_stat = $ref->getChild('apt_stat')->getValue();



$reference = $database->getReference("Pets/$pet_id");


$petname = $reference->getChild('pname')->getValue();

$breed = $reference->getChild('breed')->getValue();
$gender = $reference->getChild('gender')->getValue();
$photoUrl = $reference->getChild('photoUrl')->getValue();
$ownername = $ref->getChild('petowner')->getValue();

?>

<div class="row">

    <div class="card card-widget widget-user" style="margin-left:8px;margin-right:8px; width:770px; font-family: Segoe UI, Arial, sans-serif;" >
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header" style="background-color: #92D1C3;">
                <h1 class="widget-user-username" style="font-weight: 500; font-size:20px;">Pet Name: <?= $petname?></h1>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?php echo $photoUrl; ?>" alt="User Avatar" style="border-radius: 50%; width: 100px; height: 100px;">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?= $breed ?></h5>
                      <span class="description-text">Breed</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?= $gender ?></h5>
                      <span class="description-text">Gender</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?= $ownername ?></h5>
                      <span class="description-text">Owner name</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
       
         </div>
     </div>
     </div>  

            <input type="hidden" name="updpetid" id="updpetid" class="form-control" value="<?= $pet_id ?>">
            <input type="hidden" name="updpname" id="updpname" class="form-control" value="<?= $petname ?>">
            <input type="hidden" name="updbreed" id="updbreed" class="form-control" value="<?= $breed ?>">
            <input type="hidden" name="updgender" id="updgender" class="form-control" value="<?= $gender ?>">
            <input type="hidden" name="updweight" id="updweight" class="form-control" value="<?= $weight ?>">
            <input type="hidden" name="updownername" id="updownername" class="form-control" value="<?= $ownername ?>">
            <input type="hidden" name="updaptstat" id="updaptstat" class="form-control" value="<?= $apt_stat ?>">
            <input type="hidden" name="updid" id="updid" class="form-control"  value="<?= $petowner_id ?>">
            
<div class="card card-primary" >
      <div class="card-header" style="background-color: #92D1C3;">
                <h3 class="card-title">Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
        <input type="text" name="updaptid" id="updaptid" class="form-control" style="visibility: hidden; position:absolute;" value="<?= $apt_id ?>" readonly>
        <label for="updapttype">Type of Appointment</label>
        
            <select name="updapttype" id="updapttype" class="form-control" value = "<?= $apt_type ?>" required>
                                                            <option value="" >--- Select type of appointment---</option>
                                                            <option value="Check-up" <?php echo $apt_type == 'Check-up' ? 'selected' : ''?> >Check-up</option>
                                                            <option value="Surgery" <?php echo $apt_type == 'Surgery' ? 'selected' : ''?> >Surgery</option>
                                                            <option value="Vaccination" <?php echo $apt_type == 'Vaccination' ? 'selected' : ''?> >Vaccination</option>
                                                            <option value="Grooming" <?php echo $apt_type == 'Grooming' ? 'selected' : ''?> >Grooming</option>
                                                            <option value="Deworming" <?php echo $apt_type == 'Deworming' ? 'selected' : ''?> >Deworming</option>
                                                        </select>

            <label for="updaptdesc">Description</label>
                        <textarea class="form-control" id ="updaptdesc" rows="3" value =""><?= $apt_desc?></textarea>
                
       <!-- Date -->
       <div class="form-group">
                  <label>Current Date Set:</label>
                  <input type="text" class="form-control" id="oldate" value="<?php echo $apt_date ?>" readonly/>
                   
                </div>
                <div class="form-group">
                <label>Current Time:</label>
                <input type="text" class="form-control" id="oldtime" value="<?php echo $apt_time ?>" readonly/>
                   
                </div>
                <div class="form-group">
                <label>New  Date Set:</label>
                <div class="input-group date" id="updaptdate" data-target-input="nearest">
                   
                   <input type="text" class="form-control datetimepicker-input" data-target="#updaptdate" id="updaptdates" placeholder="mm/dd/yy"/>
                   <div class="input-group-append" data-target="#updaptdate" data-toggle="datetimepicker">
                       <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                   </div>
               </div>
                </div>
            
        <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Set New Time:</label>

                    <div class="input-group date" id="updapttime" data-target-input="nearest">
                    <select class="form-control" style="background-color: #F1F5FF; margin-top: -5px; " id="updapttimes" required>                       
                        <option selected disabled value="">--- Set time---</option>
                        <option value="9:00 AM to 9:30 AM" >9:00 AM to 9:30 AM</option>
                        <option value="9:30 AM to 10:00 AM" >9:30 AM to 10:00 AM</option>
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

                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
<?php

?>

<script>

    $(function () {
      
  var timeOptions = $('#updapttimes option'); // get all time options
  $('#updaptdate').datetimepicker({
    format: 'L',
    minDate: new Date(),
    placeholder: 'MM/DD/YY'
});

  $('#updaptdate').on('change.datetimepicker', function (e) {
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
