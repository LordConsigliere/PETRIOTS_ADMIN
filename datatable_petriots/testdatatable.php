<?php
include('dbcon.php');


$ref = $database->getReference('Appointments');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    $data[] = [
        'apt_id' => $value['apt_id'],
        'apt_date' => $value['apt_date'],
        'apt_time' => $value['apt_time'],
        'apt_desc' => $value['apt_desc'],
        'apt_stat' => '<span class="badge bg-warning">'. $value['apt_stat'].'</span>',
        'pet_name' => $value['pet_name'],
        'apt_type' => $value['apt_type'],
        'action' => '<div class = "circle-icon">                                                           
        <a class="viewbtn" data-id="'.$value['apt_id'].'" ><i class="bi bi-eye-fill"></i></a>
            </div>  
    
        <div class = "circle-update"> 
            <a class="editbtn" data-id="'.$value['apt_id'].'"><i class="bi bi-pencil-square"></i></a>  
            </div>
    
        <div class = "circle-del"> 
            <a class="delbtn"  data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#backdrop" data-id="'.$value['apt_id'].'"><i class="bi bi-trash"></i></a>  
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
