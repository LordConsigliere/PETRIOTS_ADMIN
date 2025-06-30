<?php
include('dbcon.php');


$ref = $database->getReference('Appointments');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    if ($value['apt_stat'] == "Pending") {
        $data[] = ['apt_date' => $value['apt_date'],
            'apt_time' => $value['apt_time'],
            'apt_desc' => $value['apt_desc'],
            'apt_stat' => '<span class="badge bg-warning">'. $value['apt_stat'].'</span>',   
            'pet_name' => $value['pet_name'],
            'apt_type' => $value['apt_type'],
            'action' => '<div class="circle-icon">                                                           
                            <a class="checkapt" data-id="'.$value['apt_id'].'" >
                                <i class="bi bi-check-lg"></i>
                            </a>
                         </div>  
                         <div class="circle-del"> 
                            <a class="delbtn" data-id="'.$value['apt_id'].'">
                                <i class="bi bi-x-lg"></i>
                            </a>  
                         </div>',
        ];
    }
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
