<?php
require_once("../../database.php");
$data = json_decode(file_get_contents("php://input"));
$patient_id=$data->patient_id;

$sql="SELECT * FROM patient_registration where patient_id='{$patient_id}' or phone='{$patient_id}'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
if(mysqli_num_rows($res)>=1)
{
	$service=array();
	$row = mysqli_fetch_array($res);
	$service['patient_name'] = $row['patient_name'];	
	print json_encode($service);
}
else
{

  $service['patient_name'] ="404";
  print json_encode($service);
}


?>