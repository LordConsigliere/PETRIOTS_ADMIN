<?php
include('dbcon.php');

$analyze_id = $_POST['id'];

$childNames = [
  'vomit',
  'appetite',
  'lethargy',
  'fever',
  'cough_sneeze',
  'diarrhea',
  'weight_loss',
  'drool',
  'dehy',
  'nosebleed',
  'jaundice',
  'urine',
  'nasal',
  'aggressive',
  'seizure',
  'breath'
];

$ref = $database->getReference("Analytics/$analyze_id");
$refer = $database->getReference("Pets/" . $ref->getChild('pet_id')->getValue());

$data = $ref->getValue();
$petData = $refer->getValue();

$date = $data['date'];
$nop = $data['nop'];
$status = $data['status'];
$diag = $data['diag'];
$photoUrl = $petData['photoUrl'];

// Get the snapshot of the reference
$snapshot = $ref->getSnapshot();

// Initialize an array to store the child values
$childValuesArray = [];

// Iterate through the specific child names
foreach ($childNames as $childName) {
    // Check if the child node exists
    if ($snapshot->hasChild($childName)) {
        // Get the value of the child node
        $childValue = $snapshot->getChild($childName)->getValue();
        // Store the child value in the array
        $childValuesArray[] = $childValue;
    }
}

// Combine the child values into a string
$childValues = implode(' ', $childValuesArray);

// Set the value of the input field with the combined child values
echo '<input type="text" id="childValues" class="form-control" name="childValues" value="' . $childValues . '" hidden>';

$symptoms = [
    'vomit' => ($data['vomit'] == 1) ? "Yes" : "No",
    'appetite' => ($data['appetite'] == 1) ? "Yes" : "No",
    'lethargy' => ($data['lethargy'] == 1) ? "Yes" : "No",
    'fever' => ($data['fever'] == 1) ? "Yes" : "No",
    'cough_sneeze' => ($data['cough_sneeze'] == 1) ? "Yes" : "No",
    'diarrhea' => ($data['diarrhea'] == 1) ? "Yes" : "No",
    'weight_loss' => ($data['weight_loss'] == 1) ? "Yes" : "No",
    'drool' => ($data['drool'] == 1) ? "Yes" : "No",
    'dehy' => ($data['dehy'] == 1) ? "Yes" : "No",
    'nose' => ($data['nosebleed'] == 1) ? "Yes" : "No",
    'jaun' => ($data['jaundice'] == 1) ? "Yes" : "No",
    'urine' => ($data['urine'] == 1) ? "Yes" : "No",
    'nasal' => ($data['nasal'] == 1) ? "Yes" : "No",
    'aggressive' => ($data['aggressive'] == 1) ? "Yes" : "No",
    'seizure' => ($data['seizure'] == 1) ? "Yes" : "No",
    'breath' => ($data['breath'] == 1) ? "Yes" : "No"
];


?>

<input type="text" id="id" class="form-control" name="id" value="<?= $analyze_id ?>" hidden>
<input type="text" id="date" class="form-control" name="date" value="<?= $date ?>" hidden>
<input type="text" id="nop" class="form-control" name="nop" value="<?= $nop ?>" hidden>
<input type="text" id="status" class="form-control" name="status" value="<?= $status ?>" hidden>

<div class="row">
  <div class="card card-primary card-outline" style="margin-left:35px;margin-right:35px; width: 500px;">
    <div class="card-body box-profile">
      <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="<?= $photoUrl ?>" alt="User profile picture" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
      </div>

      <h3 class="profile-username text-center"><?= $nop ?></h3>

      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <b>Pet ID:</b> <a class="float-right"><?= $data['pet_id'] ?></a>
        </li>
        <li class="list-group-item">
          <b>Date:</b> <a class="float-right"><?= $date ?></a>
        </li>
        <li class="list-group-item">
          <b>Status:</b> <a class="float-right"><?= $status ?></a>
        </li>
        <li class="list-group-item">
          <b>Pre-diagnosis:</b> <a class="float-right" style="font: size 13.7em;"><?= $diag ?></a>
        </li>
      </ul>
    </div>
    <!-- /.card-body -->
  </div>

  <div class="card" style="margin-left:30px; width: 470px; font-size: 12px;">
    <div class="card-body">
      <h4 class="text-left">Symptoms</h4>
      <br>

      <table class="table">
        <?php foreach ($symptoms as $symptomName => $symptomValue) : ?>
          <tr>
            <th width="40%" class="text-left"><?= ucfirst(str_replace('_', ' ', $symptomName)) ?>:</th>
            <td><?= $symptomValue ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>