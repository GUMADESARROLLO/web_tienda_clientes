<?php 
require 'db.php';
header('Content-type: text/json');
$sel = $con->query("select * from code where status = 1");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}
$returnArr = array("data"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Country Code List Founded!");
echo json_encode($returnArr);
?>