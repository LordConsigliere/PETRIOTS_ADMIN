<?php
include('dbcon.php');


$ref = $database->getReference('PetOwners');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    $data[] = [
        'owname' => $value['firstName']." ".$value['lastName'],
        'sex' => $value['sex'],
        'email' => $value['email'],
        'pnum' => $value['pnum'],
        'action' => '
        <div class = "circle-update"> 
            <a class="editowner" data-id="'.$value['ownerid'].'"><i class="bi bi-pencil-square"></i></a>  
            </div>',
    ];
}

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search']['value'];

if (!empty($searchValue)) {
    $filteredData = array_filter($data, function($row) use ($searchValue) {
        foreach ($row as $value) {
            if (stripos($value, $searchValue) !== false) {
                return true;
            }
        }
        return false;
    });
} else {
    $filteredData = $data;
}

$response = [
  "draw" => $draw,
  "recordsTotal" => count($data),
  "recordsFiltered" => count($filteredData),
  "data" => array_slice($filteredData, $start, $length)
];

echo json_encode($response);
?>
