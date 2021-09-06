<?php 
require 'db.php';
$sqlsrv = new Sqlsrv();
/*$data = array(
    "category_id" => '1'
);*/



$data = json_decode(file_get_contents('php://input'), true);



if($data['category_id'] == ''){
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}else{
	$cat_id = $data['category_id'];	
	
	$query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.ID_CLAS_3,T0.Clasificacion_3,COUNT(T0.ID_CLAS_3) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 = '".$cat_id."'  AND STOCK > 30 GROUP BY T0.ID_CLAS_1,T0.ID_CLAS_3,T0.Clasificacion_3 HAVING COUNT(T0.ID_CLAS_3) > 0 ", SQLSRV_FETCH_ASSOC);
	if(count($query) != 0){

		$myarray = array();

		foreach ($query as $fila) {


	        $p['id'] = $fila['ID_CLAS_1'];
	  		$p['cat_id'] = $fila['ID_CLAS_3'];
			$p['name'] = $fila['Clasificacion_3'];
			$p['img'] = "product/icon_sub_categoria.png";
			$p['count'] = $fila['CNT'];
			$myarray[] = $p;


		}
		$returnArr = array("data"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"OK");


	}else {
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"SubCategory Not Found!!!");	
	}
}
echo json_encode($returnArr);
?>