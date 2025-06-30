<?php
include('dbcon.php');


$ref = $database->getReference('Appointments');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    if ($value['apt_stat'] == "Cancelled" || $value['apt_stat'] == "Confirmed") {
    $data[] = [
        'apt_date' => $value['apt_date'],
        'apt_time' => $value['apt_time'],
        'apt_desc' => $value['apt_desc'],
        'apt_stat' => ($value['apt_stat'] == "Cancelled")
        ? '<span class="badge bg-danger">'. $value['apt_stat'].'</span>'
        : (($value['apt_stat'] == "Pending")
        ? '<span class="badge bg-warning">'. $value['apt_stat'].'</span>'
        : (($value['apt_stat'] == "Confirmed")
        ? '<span class="badge bg-success">'. $value['apt_stat'].'</span>'
        : (($value['apt_stat'] == "Complete")
        ? '<span class="badge bg-info">'. $value['apt_stat'].'</span>'
        : $value['apt_stat']
        )
        )
        ),      
        'pet_name' => $value['pet_name'],
        'apt_type' => $value['apt_type'],
        'action' => ($value['apt_stat'] == "Cancelled") 
            ? '<div class = "circle-icon">                                                           
                <a class="viewapt" data-id="'.$value['apt_id'].'" ><i class="bi bi-eye-fill"></i></a>
                </div> '
            : (($value['apt_stat'] == "Confirmed") 
            
                ?  '<div class = "circle-icon"> 
                <a class="checkapt" data-id="'.$value['apt_id'].'" ><i class="bi bi-check-lg"></i></a>
                </div>  
        
            <div class = "circle-update"> 
                <a class="editbtn" data-id="'.$value['apt_id'].'"><i class="bi bi-pencil-square"></i></a>  
                </div>
        
            <div class = "circle-del"> 
                <a class="delbtn" data-id="'.$value['apt_id'].'"><i class="bi bi-x-lg"></i></a>  
                </div>      
                ': $value['apt_stat']
            ),
    

        ];
    }
}

usort($data, function($a, $b) {
    if ($b['apt_stat'] == $a['apt_stat']) {
        return 0;
    }
    return ($b['apt_stat'] < $a['apt_stat']) ? -1 : 1;
});

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
