
<?php 

include('config.php');

$output= array();
$sql = "SELECT * FROM petowners";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'ownername',
	2 => 'numofpets',
	3 => 'pnum',
    4 => 'email',
	5 => 'address',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE id like '%".$search_value."%'";
	$sql .= " OR ownername like '%".$search_value."%'";
	$sql .= " OR numofpets like '%".$search_value."%'";
	$sql .= " OR pnum like '%".$search_value."%'";
    $sql .= " OR email like '%".$search_value."%'";
    $sql .= " OR address like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id asc";
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
	$sub_array[] = $row['ownername'];
	$sub_array[] = $row['numofpets'];
    $sub_array[] = $row['pnum'];
	$sub_array[] = $row['email'];
    $sub_array[] = $row['address'];
    $sub_array[] = 
    '<div class = "circle-icon">                                                           
    <a class="viewowner" data-id="'.$row['id'].'" ><i class="bi bi-eye-fill"></i></a>
        </div>  
        ';

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



