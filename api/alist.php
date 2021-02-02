<?php 
 
 require 'db.php';
$sqlsrv = new Sqlsrv();
$data = json_decode(file_get_contents('php://input'), true);

/*$data = array(
    "uid" => '130',
    "cod_client" => '00012',
);*/
$uid = $data['uid'];

	if($uid == ''){
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
	}else{
        $p = array();
        $q = array();
        $qAdress = $sqlsrv->fetchArray("SELECT * FROM GMV_Clientes_address T0 WHERE T0.CLIENTE ='".$data['cod_client']."'", SQLSRV_FETCH_ASSOC);
        foreach ($qAdress as $Row_Address) {
            $p['id'] 		= "00";
            $p['uid'] 		= "";
            $p['Titulo'] 	= "Default";
            $p['Direec'] 	= $Row_Address["DIRECCION"];
            $p['area'] 		= $Row_Address["DIVISION_GEOGRAFICA2"];
            $p['Referecia'] = "Dirección de Sistema.";
            $p['status'] 	= "1";
            $q[] = $p;
        }

		$cy = $con->query("select * from address where uid=".$uid." and status='1'");
		$count = $con->query("select * from address where uid=".$uid." and status='1'")->num_rows;

        while($row = $cy->fetch_assoc()){
            $p['id'] 		= $row['id'];
            $p['uid'] 		= $row['uid'];
            $p['Titulo'] 	= $row['Titulo'];
            $p['Direec'] 	= $row['Direec'];
            $p['area'] 		= $row['area'];
            $p['Referecia'] = $row['Referecia'];
            $p['status'] 	= $row['status'];

            $q[] = $p;
        }
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Lista de direcciones ¡Consiga con éxito!","ResultData"=>$q);


		/*if($count != 0){


		}else{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"¡¡Dirección no encontrada !!");
		}*/
}
echo json_encode($returnArr);
mysqli_close($con);
?> 	