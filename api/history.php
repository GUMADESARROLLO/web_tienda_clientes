<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
    $uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
  $sel = $con->query("select * from orders where uid=".$uid." order by id desc"); 
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $Id = substr("00000000", strlen($row['id'])).$row['id'];

      $g['id'] = $Id;
      $g['oid'] = $row['oid'];
      $oid = $row['oid'];
      $g['status'] = $row['status'];
      $g['order_date'] = $row['ddate'];
	  $g['total'] = $row['total'];
      $rdata = $con->query("select * from rider where id=".$row['rid']."")->fetch_assoc();
	  $g['rider_status'] = $row['r_status'];
	  $g['rider_name'] = $rdata['name'];
	  $g['rider_mobile'] = $rdata['mobile'];
      $po[] = $g;
      
  }
  $returnArr = array("Data"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Listp");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No tiene Ordenes");
  }
}
echo json_encode($returnArr);