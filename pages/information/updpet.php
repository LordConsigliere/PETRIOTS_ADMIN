<?php
include('dbcon.php');

$petid = $_POST['petid'];


$ref = $database->getReference("Pets/$petid");

$pname = $ref->getChild('pname')->getValue();

$species = $ref->getChild('species')->getValue();

$breed = $ref->getChild('breed')->getValue();

$weight = $ref->getChild('weight')->getValue();

$gender = $ref->getChild('gender')->getValue();

$status = $ref->getChild('status')->getValue();

$photoUrl = $ref->getChild('photoUrl')->getValue();

$ownername = $ref->getChild('ownername')->getValue();

$age = $ref->getChild('age')->getValue();
$bday = $ref->getChild('bday')->getValue();






$ownerid = $ref->getChild('ownerid')->getValue();





?>

 
            <!-- Widget: user widget style 2 -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src= <?= $photoUrl ?>
                       alt="User profile picture"  style="border-radius: 50%; width: 173px; height: 173px; object-fit: cover;">
                </div>

                <h3 class="profile-username text-center"><?= $pname ?></h3>

                <p class="text-muted text-center"><?= $breed ?></p>

                <strong><i class="fas fa-book mr-1"></i>Gender</strong>

                        <p class="text-muted">
                       <?= $gender ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Birthdate</strong>

                        <p class="text-muted"><?= $bday ?></p>


                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i>Pet Description</strong>

                        <p class="text-muted">
                        <span class="tag tag-danger">Weight: <?= $weight ?> ,</span>
                        <span class="tag tag-success">Spayed/Neutured: <?= $status ?></span>

                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Ownername </strong>

                        <p class="text-muted"><?= $ownername ?></p>
              </div>
              <!-- /.card-body -->
          
            <!-- /.widget-user -->
        
  <!-- 
          <div class="col-md-9">
          <div class="card">
                   
         

              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" id="his_vac" data-toggle="tab">Vaccination History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" id="his_diag" data-toggle="tab">Previous Diagnosis</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Surgeries</a></li>
                </ul>
   
              </div>
              <div class="card-header" id="header_vac">
                <button type="button" class="btn btn-primary" id="btn_addapt" style="float: right; background-color: #92D1C3; border-color: #92D1C3;"><i class="bi bi-plus-circle"></i> Add</button>
              </div>

              <div class="card-header" id="header_diag" style="display:none;">
                <button type="button" class="btn btn-primary" id="btn_addapt" style="float: right; background-color: #92D1C3; border-color: #92D1C3;"><i class="bi bi-plus-circle"></i> Add</button>
              </div>
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="activity">
      
                  
                    <table id="vac_table" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date of Vaccination</th>
                            <th>Type of Vaccine</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                  </div>
                 
                  <div class="tab-pane" id="timeline">
                  <table id="vac_table" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Diagnosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                  </table>

                  </div>
               

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                     
                    </form>
                  </div>
               
                </div>
            
              </div>
            </div>
            </div> -->
</div>

<script>
  var vac_table;  
jQuery(document).ready(function ($){
  var petid = "<?php echo $petid; ?>";
vac_table = $('#vac_table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        
        "ajax": {
            "url": "/AdminLTE/datatable_petriots/datatable_vac.php",
            "type": "POST",
            "data": function(data) {
                // data processing here
                data.petid = petid;
            },
            "dataSrc": function(response) {
                // decode the JSON response and return the data
                return response.data;
            }
        },
        
        "columns": [
            { "data": "vid" },
            { "data": "date" },
            { "data": "tov" },
           
        ],
      
      });
    });

   
    $('#his_vac').on('click', function() {

      $("#header_vac").show();
      $("#header_diag").hide();
    });

    $('#his_diag').on('click', function() {

    $("#header_vac").hide();
    $("#header_diag").show();


});
</script>