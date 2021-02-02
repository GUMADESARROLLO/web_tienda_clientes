<?php 
require 'db.php';
/*$data = array(
    "mobile" => '00660',
    "password" => '123456',
    "imei" => '123456',
    "player_id" => '123456'
);*/
    $data = json_decode(file_get_contents('php://input'), true);
    
    if($data['mobile'] == ''  or $data['password'] == ''){
        $returnArr = array(
            "ResponseCode"=>"401",
            "Result"=>"false",
            "ResponseMsg"=>"Something Went Wrong!"
        );
    }else{
        $mobile = strip_tags(mysqli_real_escape_string($con,$data['mobile']));
        $imei = strip_tags(mysqli_real_escape_string($con,$data['imei']));
        $password = strip_tags(mysqli_real_escape_string($con,$data['password']));
        $player_id = strip_tags(mysqli_real_escape_string($con,$data['player_id']));

        
    
        $chek = $con->query("select * from user where (cod_client='".$mobile."' ) and status = 1 and password='".$password."'");
        $status = $con->query("select * from user where status = 1");
        if($status->num_rows !=0){
            if($chek->num_rows != 0){
                $c = $con->query("select * from user where (cod_client='".$mobile."' )  and status = 1 and password='".$password."'");
                $c = $c->fetch_assoc();
                $dc = $con->query("select * from area_db where id='".$c['aid']."'");
                $vb = $dc->fetch_assoc();

                $returnArr = array(
                    "user"=>$c,
                    "d_charge"=>$vb['dcharge'],
                    "ResponseCode"=>"200",
                    "Result"=>"true",
                    "ResponseMsg"=>"Iniciar sesión correctamente"
                );
                $con->query("update user set player_id='".$player_id."' where cod_client='".$mobile."' and status = 1 and password='".$password."'");
            }else{
                $returnArr = array(
                    "ResponseCode"=>"401",
                    "Result"=>"false",
                    "ResponseMsg"=>"Numero de Cliente Invalido"
                );
            }
        }else{
	        $returnArr = array(
	            "ResponseCode"=>"401",
                "Result"=>"false",
                "ResponseMsg"=>"Tu Cuenta esta desactivada!!!"
            );
    }
}

echo json_encode($returnArr);