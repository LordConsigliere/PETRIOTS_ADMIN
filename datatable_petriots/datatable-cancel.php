
<?php 

include('config.php');

$output= array();
$sql = "SELECT * FROM cancel_apt";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'del_aptid',
	2 => 'del_aptname',
	3 => 'del_aptdate',
    4 => 'del_apttime',
	5 => 'del_apttype',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE id like '%".$search_value."%'";
	$sql .= " OR del_aptid like '%".$search_value."%'";
	$sql .= " OR del_aptname like '%".$search_value."%'";
	$sql .= " OR del_aptdate like '%".$search_value."%'";
    $sql .= " OR del_apttime like '%".$search_value."%'";
    $sql .= " OR del_apttype like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();

while($row = mysqli_fetch_assoc($query))
{

    $sub_array = array();
    $sub_array[] = $row['id'];
	$sub_array[] = $row['del_aptid'];
	$sub_array[] = $row['del_aptname'];
    $sub_array[] = $row['del_aptdate'];
	$sub_array[] = $row['del_apttime'];
    $sub_array[] = $row['del_apttype'];
    
    $data[] = $sub_array;


}
$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo json_encode($output);

?>



