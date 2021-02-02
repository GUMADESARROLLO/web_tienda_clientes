<?php 
require 'db.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$sqlsrv = new Sqlsrv();


if(!isset($_POST['searchTerm'])){
    $query = $sqlsrv->fetchArray("SELECT * FROM UMK_STORE_MASTER T0 WHERE T0.STOCK > 0  ", SQLSRV_FETCH_ASSOC);
}else{
    $search = $_POST['searchTerm'];
    $query = $sqlsrv->fetchArray("select TOP 5 * from UMK_STORE_MASTER T0 where T0.DESCRIPCION like '%".$search."%' OR T0.ARTICULO like '%".$search."%' ");
}


if(count($query) != 0){
        $data = array();
        foreach ($query as $fila) {
            $data[] = array("id"=>$fila['ARTICULO'], "text"=>strtoupper($fila['DESCRIPCION']));
        }
    echo json_encode($data);
}else{
    echo "dont touch";
}
