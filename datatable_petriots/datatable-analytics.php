
<?php
include('dbcon.php');


$ref = $database->getReference('Analytics');
$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
 
        $data[] = [

            'date' => $value['date'],
            'nop' => $value['nop'],
            'diag' => $value['diag'],
            'status' => ($value['status'] == "Pending") 
            ? '<span class="badge bg-warning">'. $value['status'].'</span>' 
            : (($value['status'] == "Complete") 
                ? '<span class="badge bg-success">'. $value['status'].'</span>' 
                : $value['status']
            ),
                'action' => ($value['status'] == "Complete") 
                ? '<div class = "circle-icon">                                                           
                    <a class="view_analytics" data-id="'.$value['id'].'" ><i class="bi bi-eye-fill"></i></a>
                    </div> '
                : (($value['status'] == "Pending") 
                    ?  '<div class = "circle-icon">                                                           
                    <a class="view_analytics" data-id="'.$value['id'].'" ><i class="bi bi-eye-fill"></i></a>
                        </div>  
                    <div class = "circle-analyze"> 
                        <a class="analyzebtn" data-id="'.$value['id'].'"><i class="bi bi-database-fill-add"></i></a>  
                        </div>      
                    ': $value['status']
                ),
        ];
    
}

function compareDates($a, $b) {
    // Convert the date strings to timestamps for comparison
    $timestampA = strtotime($a['date']);
    $timestampB = strtotime($b['date']);

    // Sort in descending order (latest date first)
    if ($timestampA == $timestampB) {
        return 0;
    }
    return ($timestampA < $timestampB) ? 1 : -1;
}

// Sort the $data array using the custom comparison function
usort($data, 'compareDates');

usort($data, function($a, $b) {
    if ($b['status'] == $a['status']) {
        return 0;
    }
    return ($b['status'] < $a['status']) ? -1 : 1;
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
