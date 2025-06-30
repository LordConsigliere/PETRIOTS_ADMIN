<?php
include('dbcon.php');

$petid = $_POST['petid'];

$ref = $database->getReference("Pets/$petid/vac_his");

$snapshot = $ref->getSnapshot();

$data = [];
foreach ($snapshot->getValue() as $value) {
    if (is_array($value) && array_key_exists('vid', $value) && 
    array_key_exists('date', $value) && array_key_exists('tov', $value)) {
    $data[] = [
        'vid' => $value['vid'],
        'date' => $value['date'],
        'tov' => $value['tov'],
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
