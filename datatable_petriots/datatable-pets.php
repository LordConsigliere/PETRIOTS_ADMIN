<?php
include('dbcon.php');


$ref = $database->getReference('Pets');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    $data[] = [
        'petid' => $value['petid'],
        'pname' => $value['pname'],
        'gender' => $value['gender'],
        'status' => $value['status'],
        'breed' =>  $value['breed'],
        'bday' => $value['bday'],
        'weight' => $value['weight'],
		'ownerid' => $value['ownerid'],
        'ownername' => $value['ownername'],
        'action' => '
        <div class = "circle-update"> 
            <a class="editpet" data-id="'.$value['petid'].'"><i class="bi bi-pencil-square"></i></a>  
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
