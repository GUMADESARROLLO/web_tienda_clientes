<?php 
require 'db.php';
header('Content-type: text/json');

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


$sqlsrv = new Sqlsrv();
$myarray = array();
$query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.Clasificacion_1, COUNT(T0.ID_CLAS_1) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 NOT IN (7)  AND T0.STOCK > 0 AND T0.PRECIO > 0 GROUP BY T0.ID_CLAS_1,T0.Clasificacion_1 ", SQLSRV_FETCH_ASSOC);
foreach ($query as $fila) {
        $found_key = array_search($fila['ID_CLAS_1'], array_column($imagenes_categoria, 'category_id'));


        $p['id']        = $fila['ID_CLAS_1'];
        $p['catname']   = $fila['Clasificacion_1'];
        $p['catimg']    = $imagenes_categoria[$found_key]['Imagen'];
        $p['count']     = $fila['CNT'];
        $myarray[]      = $p;
}
$returnArr = array("data"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category List Founded!");


echo json_encode($returnArr);


?>