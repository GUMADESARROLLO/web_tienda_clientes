<?php 
require 'db.php';
$sqlsrv = new Sqlsrv();
/*$data = array(
    "keyword" => 'anestil'
);*/
$data = json_decode(file_get_contents('php://input'), true);


if($data['keyword'] != '')
{
    
   $query = $sqlsrv->fetchArray("SELECT * FROM UMK_STORE_MASTER T0 WHERE T0.DESCRIPCION like '%".$data['keyword']."%'  AND T0.STOCK > 30", SQLSRV_FETCH_ASSOC);
    
   if(count($query) != 0){
   
    foreach ($query as $fila) {

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
                $k[$i] = array("product_type"=>$a[$i],"product_price"=> str_replace(',', '', number_format($ab[$i],2))   );
            }   
            $result['price'] = $k;
            $result['stock'] = str_replace(',', '', number_format($fila['STOCK'],0));
            $result['discount'] = $set_desc;
            $result['mIva'] = number_format($fila['IMPUESTO'],0);
            $result['bonificado'] = $fila['REGLAS'];
            $result['Categoria'] = ($fila['ID_CLAS_2']=="88") ? $fila['ID_CLAS_2'] : $fila['ID_CLAS_3'];
            $pp[] = $result;
        }
        $returnArr = array("data"=>$pp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Correcto");
    }
    else{
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Lista de productos no encontrada!");
    }
    echo json_encode($returnArr);
}else{
    echo "dont touch";
}


