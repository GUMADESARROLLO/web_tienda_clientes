<?php 
require 'db.php';
/*$data = array(
    "id" => '29',
    "uid" => '130',
);*/



$data = json_decode(file_get_contents('php://input'), true);
$var_address_text = "";

if($data['uid'] == ''){ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}else{
  $id = strip_tags(mysqli_real_escape_string($con,$data['id']));
  $uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
 
  $sel = $con->query("select * from orders where uid=".$uid." and id=".$id."");
  
  
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc()){

      $Id = substr("00000000", strlen($row['id'])).$row['id'];
    $oid = $row['oid'];
      $var_address_text = $row['address_txt'];

    $order_comentario = $row['Comentario'];

    $order_comentario .= ($row['timesloat']=="") ? "" : " [ CUPON: #" .$row['timesloat'] . " ]";

    $id = $Id;
    $a = explode('$;',$row['pname']);    
    $p = explode('$;',$row['pprice']);
    $c = explode('$;',$row['ptype']);
    $d = explode('$;',$row['qty']);
    $e = explode('$;',$row['pid']);
    $b = explode('$;',$row['boni']);
    $k=array();
	  $subtotal = 0;
	  $ksub = array();

    for($i=0;$i<count($a);$i++){		
      
      $set_img ="http://186.1.15.167:8448/tnd/product/ND.png";  

      $query = "SELECT p.product_image,p.product_description FROM tbl_product p WHERE p.product_sku= '".$e[$i]."'";
      $resouter = mysqli_query($connect, $query);
      $total_records = mysqli_num_rows($resouter);
      if($total_records >= 1) {
        $link = mysqli_fetch_array($resouter, MYSQLI_ASSOC);
        $set_img = "http://186.1.15.166:8448/gmv3/upload/product/".$link['product_image'];
      }
        $ksub[] =number_format((float)$p[$i], 2, '.', '') * $d[$i];


		  $k[$i] = array(
            "product_name"=>$a[$i],
            "product_price"=>number_format((float)$p[$i], 2, '.', ''),
            "product_weight"=>$c[$i],"product_qty"=>$d[$i],
            "product_image"=>$set_img,
            "discount"=>"0",
            "product_sku"=>$e[$i],
            "product_Boni"=>$b[$i]
            );
    }
    
    
    if($row['p_method'] == 'Pickup myself' and $row['status'] != 'completed' and $row['status'] != 'cancelled'){
        $status = $row['p_method'];
    }else {
      $status =$row['status'];
    }



    $p_method = str_replace(array("C$", ","), "", $row['p_method']);
    $total =$row['total'] ;
    $odate = $row['ddate'];
    $timesloat = $row['timesloat'];
    $tax = $row['tax'];
    $address_id = $row['address_id'];
    $rid = $row['rid'];

    $px = $row['porcent_cupon'];

    //$Descuento = (float) substr($row['p_method'],3);

    $String = array("C$", ",");

    $Descuento = str_replace($String, "", $row['p_method']);



    //$result['total'] = $row['total'];
    //$result['status'] = $row['status'];
    //$result['order_date'] = $row['order_date'];
    //$result['timesloat'] = $row['timesloat'];
    //$pp[] = $result;

    

     
    }
   
    $orate = $con->query("select * from rate_order where oid='".$id."'");
      if($orate->num_rows != 0){
        $rate = 'Yes';
      }else {
        $rate = 'No';
      }
      $rider = $con->query("select * from rider where id=".$rid."")->fetch_assoc();

      $c = $con->query("select * from address where id=".$address_id."");
      $c = $c->fetch_assoc();
	    $address_cust = $var_address_text;


      $atype = $c['Titulo'];
      $cname = $c['Referecia'];
      $dc = $con->query("select * from area_db where name='".$c['area']."'");
      $dc = $dc->fetch_assoc();
			
			
      $returnArr = array(
        "productinfo"=>$k,
        "Sub_total"=>array_sum($ksub),
        "orderid"=>$id,
        "Comment"=>$order_comentario,
        "address"=>$address_cust,
        "address_type"=>$atype,
        "customer_name"=>$cname,
        "total_amt"=>$total - $Descuento,
        "rider_mobile"=>$rider['mobile'],
        "rider_name"=>$rider['name'],
        "p_method"=>$p_method,
        "status"=>$status,
        "order_date"=>$odate,
        "timesloat"=>$timesloat,
        "Israted"=>$rate,
        "d_charge"=>$px,
        "tax"=>$tax,
        "ResponseCode"=>"200",
        "Result"=>"true",
        "ResponseMsg"=>"éxito!"
      );
}
echo json_encode($returnArr);