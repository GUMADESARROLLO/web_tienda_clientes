<?php
 	require 'db.php';
	$data = json_decode(file_get_contents('php://input'), true);

	$uid 		= $data['uid'];
	$aid 		= $data['aid'];
	$area 		= $data['area'];
	$vTitulo 	= mysqli_real_escape_string($con,$data['Titulo']);
	$vDirec 	= mysqli_real_escape_string($con,$data['Direc']);
	$vRefe 		= mysqli_real_escape_string($con,$data['Refe']);

	if($vTitulo == '' or $vDirec == '' or $vRefe == '' or $uid == '' ){
		$returnArr = array(
			"ResponseCode"=>"401",
			"Result"=>"false",
			"ResponseMsg"=>"Something Went wrong  try again !"
		);
	}else{
        $count = $con->query("select * from user where id=".$uid." and status = 1")->num_rows;
		if($count != 0){
            if($aid == 0){
                $con->query("INSERT INTO address(`uid`,`area`,`Titulo`,`Direec`,`Referecia`)values(".$uid.",'".$area."','".$vTitulo."','".$vDirec."','".$vRefe."')");
                $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Saved Successfully!!!");
            }else{
                $con->query("UPDATE address SET area='".$area."',Titulo='".$vTitulo."',Direec='".$vDirec."',Referecia='".$vRefe."' where id=".$aid."");
                $adata = $con->query("select * from address where id=".$aid."")->fetch_assoc();

                $p = array();
                $p['id'] = $adata['id'];
                $p['uid'] = $adata['uid'];
                $p['hno'] = $adata['hno'];
                $p['society'] = $adata['society'];
                $p['area'] = $adata['area'];
                $p['IS_UPDATE_NEED'] = FALSE;
                $returnArr = array("Address"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Dirección actualizada con éxito !!!");

            }

		}else{
            $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
		}
	}
echo json_encode($returnArr);
mysqli_close($con);
?> 