<?php 
require 'db.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$sqlsrv = new Sqlsrv();


if(!isset($_POST['searchTerm'])){
    $query = $sqlsrv->fetchArray("SELECT * FROM GMV_Clientes T0 WHERE T0.ACTIVO='S' ", SQLSRV_FETCH_ASSOC);
}else{
    $search = $_POST['searchTerm'];
    $query = $sqlsrv->fetchArray("select TOP 5 * from GMV_Clientes T0 where T0.NOMBRE like '%".$search."%' OR T0.CLIENTE like '%".$search."%' ");
}


if(count($query) != 0){
        $data = array();
        foreach ($query as $fila) {
            $data[] = array("id"=>$fila['CLIENTE'], "text"=>strtoupper($fila['NOMBRE']));
        }
    echo json_encode($data);
}else{
    echo "dont touch";
}
