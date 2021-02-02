<?php
$imagenes_categoria = array(
    array(
        "category_id" => 4,
        "Imagen"      => "product/Dental.png"
    ),
    array(
        "category_id" => 1,
        "Imagen"      => "product/Medicina.png"
    ),
    array(
        "category_id" => 3,
        "Imagen"      => "product/Kit.png"
    ),
    array(
        "category_id" => 6,
        "Imagen"      => "product/product.png"
    ),
    array(
        "category_id" => 2,
        "Imagen"      => "product/Vet.png"
    ),

);
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$uid = $data['uid'];
//$uid = 118;
if($uid == ''){
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}else { 
	$v = array();
	$cp = array(); 
	$d = array();
	$p = array();
	$sec = array();
    $sqlsrv = new Sqlsrv();

$sel = $con->query("select * from banner WHERE Status = 1");
while($row = $sel->fetch_assoc()){
    $v[] = $row;
}

$query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.Clasificacion_1, COUNT(T0.ID_CLAS_1) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 NOT IN (7) AND STOCK > 0 GROUP BY T0.ID_CLAS_1,T0.Clasificacion_1 ", SQLSRV_FETCH_ASSOC);
foreach ($query as $fila) {
        $found_key = array_search($fila['ID_CLAS_1'], array_column($imagenes_categoria, 'category_id'));
        $p['id'] = "00".$fila['ID_CLAS_1'];
        $p['catname'] = $fila['Clasificacion_1'];
        $p['catimg']    = $imagenes_categoria[$found_key]['Imagen'];
        $p['count'] = $fila['CNT'];
        $cp[] = $p;
}


$result = array();
$prod = $con->query("select * from product where status=1 and popular = 1 order by id desc limit 5 ");
	while($row = $prod->fetch_assoc()){
        $qSkuPromo = $sqlsrv->fetchArray("SELECT * FROM UMK_STORE_MASTER T0 WHERE T0.ARTICULO ='".$row['pname']."' ", SQLSRV_FETCH_ASSOC);
        foreach ($qSkuPromo as $fila) {
            $set_img ="http://186.1.15.167:8448/tnd/product/ND.png";
            $set_des = "";

            $set_desc = "0";
            $set_desc = $row['discount'];

            $query = "SELECT p.product_image,p.product_description FROM tbl_product p WHERE p.product_sku= '".$fila["ARTICULO"]."'";
            $resouter = mysqli_query($connect, $query);
            $total_records = mysqli_num_rows($resouter);
            if($total_records >= 1) {
                $link = mysqli_fetch_array($resouter, MYSQLI_ASSOC);
                $set_img = "http://186.1.15.166:8448/gmv3/upload/product/".$link['product_image'];
                $set_des = $link['product_description'];

            }

            $result['id'] = $fila['ARTICULO'];
            $result['product_name'] = strtoupper($fila['DESCRIPCION']);
            $result['product_image'] = $set_img;
            $result['product_related_image'] = "product/ND.png,product/ND.png,product/ND.png";
            $result['seller_name'] = "SKU: ".$fila['ARTICULO'];
            $result['short_desc'] = $set_des;
            $a = explode('$;',$fila['UNIDAD_ALMACEN']);
            $ab = explode('$;',$fila['PRECIO']);
            $k=array();
            for($i=0;$i<count($a);$i++){
                $k[$i] = array("product_type"=>$a[$i],"product_price"=> str_replace(',', '', number_format($ab[$i],2,".",","))   );
            }   
           $result['price'] = $k;
            $result['stock'] = str_replace(',', '', number_format($fila['STOCK'],0));
            $result['discount'] = $set_desc;
            $result['mIva'] = number_format($fila['IMPUESTO'],0);
            $result['bonificado'] = $fila['REGLAS'];
            $d[] = $result;
        }



	}
	

$slist = $con->query("select * from home where status = 1")->num_rows;
if($slist !=0)
{
    $plist = $con->query("select * from home where status = 1");
    
    $sev = array();
    while($rp = $plist->fetch_assoc())
    {
        $section = array();
        $sep = array();
        $sid = $rp['sid'];
        $cid = $rp['cid'];
        $rpq = $sqlsrv->fetchArray("SELECT * FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 ='".$cid."' AND T0.ID_CLAS_3='".$sid."'  AND STOCK > 0 ", SQLSRV_FETCH_ASSOC);
      
    
        foreach ($rpq as $fila) {
            $set_img ="http://186.1.15.167:8448/tnd/product/ND.png";
            $set_des = "";

            $qDescuento = $con->query("select * from product where status=1 and popular = 1 and pname='".$fila['ARTICULO']."' order by id desc limit 5 ");
            $row_DESCUENT = $qDescuento->fetch_assoc();
            $set_desc = (is_null($row_DESCUENT['discount']) ) ? "0" : $row_DESCUENT['discount'] ;

            $query = "SELECT p.product_image,p.product_description FROM tbl_product p WHERE p.product_sku= '".$fila["ARTICULO"]."'";
            $resouter = mysqli_query($connect, $query);
            $total_records = mysqli_num_rows($resouter);
            if($total_records >= 1) {
                $link = mysqli_fetch_array($resouter, MYSQLI_ASSOC);
                $set_img = "http://186.1.15.166:8448/gmv3/upload/product/".$link['product_image'];

            }

        $section['id'] = $fila['ARTICULO'];
        $section['product_name'] = strtoupper($fila['DESCRIPCION']);
        $section['product_image'] = $set_img;
    	$section['product_related_image'] = "product/ND.png,product/ND.png,product/ND.png";
        $section['seller_name'] = "SKU: ".$fila['ARTICULO'];
        $section['short_desc'] = $set_des;
        $a = explode('$;',$fila['UNIDAD_ALMACEN']);
            $ab = explode('$;',$fila['PRECIO']);
        $k=array();
        for($i=0;$i<count($a);$i++)
        {
            $k[$i] = array("product_type"=>$a[$i],"product_price"=>$ab[$i]);
        }
        
       $section['price'] = $k;
            $section['stock'] = str_replace(',', '', number_format($fila['STOCK'],0));
            $section['discount'] = $set_desc;
            $section['mIva'] = number_format($fila['IMPUESTO'],0);
            $section['bonificado'] = $fila['REGLAS'];
        $sep[] = $section;
        }
        $sev['title'] = $rp['title'];
        $sev['product_data'] = $sep;
        $sec[] = $sev;
    }


    
}else {
    
}
	$udata = $con->query("select * from user where id=".$uid."")->fetch_assoc();
	$date_time = $udata['rdate'];
	
    $remain = $con->query("select * from noti where date >='".$date_time."'")->num_rows;

	
	$read = $con->query("select * from uread where uid=".$uid."")->num_rows;
	$r_noti = $remain - $read;
	$curr = $con->query("select * from setting")->fetch_assoc();
	$kp = array('Banner'=>$v,'Catlist'=>$cp,'Productlist'=>$d,"Remain_notification"=>$r_noti,"Main_Data"=>$curr,"dynamic_section"=>$sec);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Data Get Successfully!","ResultData"=>$kp);
    echo json_encode($returnArr);
}
