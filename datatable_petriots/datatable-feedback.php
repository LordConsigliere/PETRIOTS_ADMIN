<?php
include('dbcon.php');
function generateStarRating($rating, $fid) {
    $html = '<div class="rate">';
    for ($i = 5; $i >= 1; $i--) {
        $html .= '<input type="radio" id="star_' . $fid . '_' . $i . '" name="rate_' . $fid . '" value="' . $i . '"';
        if ($i == $rating) {
            $html .= ' checked';
        }
        $html .= ' disabled>'; // add disabled attribute
        $html .= '<label for="star_' . $fid . '_' . $i . '" title="text" style="pointer-events: none">' . $i . ' stars</label>'; // add pointer-events: none CSS property
    }
    $html .= '</div>';
    return $html;
}
$ref = $database->getReference('Feedbacks');
$snapshot = $ref->getSnapshot();

$data = [];
$value = $snapshot->getValue();
if (!is_null($value)) {
    foreach ($value as $key => $row) {
        $data[] = [
            'date' => $row['date'],
            'full_name' => $row['full_name'],
            'feedback' =>  generateStarRating($row['feedback'], $row['fid']),
            'message' => $row['msg'],
            'action' => '<div class="circle-icon">                                                           
            <a class="checkfeed" data-id="'.$row['fid'].'" >
            <i class="bi bi-eye-fill"></i>
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
