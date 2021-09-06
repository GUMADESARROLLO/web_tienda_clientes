<?php 
    require 'db.php';
    $data = json_decode(file_get_contents('php://input'), true);
    if($data['uid'] == '') {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
    }else{

        $info_user      = $con->query("select * from user where id=".$data['uid']."")->fetch_assoc();
        $cod_cliente    = $info_user['cod_client'];
        $Fecha_cupon = date('y-m-d h:i:s');

        $uid =  $data['uid'];
        $ddate = $data['ddate'];
        /*$a = explode('-',$ddate);
        $ddate = $a[2].'-'.$a[1].'-'.$a[0];*/
        $timesloat = strtoupper($data['timesloat']);
        $oid ='#'.uniqid();
        $pname = $data['pname'];

        $porcent_cupon = $data['porcent_cupon'];
        
        $status = 'pendiente';
        $Comment = $data['comment'];
        $txt_Address = $data['address_txt'];
        $p_method = $data['p_method'];
        $player_id = $data['player_id'];
        $address_id = $data['address_id'];
        $tax = number_format((float)$data['tax'], 2, '.', '');
        $timestamp = date("Y-m-d");
        $tid = $data['tid'];
        $total = number_format((float)$data['total'], 2, '.', '');
        $e= array();
        $p = array();
        $w=array();
        $pp = array();
        $q = array();
        $bo = array();
        for($i=0;$i<count($pname);$i++){
            $e[] = $pname[$i]['title'];
            $p[] = $pname[$i]['pid'];
            $w[] = $pname[$i]['weight'];
            $pp[] = $pname[$i]['cost'];
            $q[] = $pname[$i]['qty'];
            $bo[] = $pname[$i]['Boni'];
        }
        $pname = implode('$;',$e);
        $pid = implode('$;',$p);
        $ptype = implode('$;',$w);
        $pprice = implode('$;',$pp);
        $qty = implode('$;',$q);
        $b = implode('$;',$bo);

        $con->query("INSERT INTO orders(`porcent_cupon`,`oid`,`uid`,`pname`,`pid`,`ptype`,`pprice`,`ddate`,`timesloat`,`order_date`,`status`,`qty`,`boni`,`total`,`p_method`,`address_id`,`tax`,`tid`,`player_id`,`Comentario`,`address_txt`)VALUES('".$porcent_cupon."','".$oid."',".$uid.",'".$pname."','".$pid."','".$ptype."','".$pprice."','".$ddate."','".$timesloat."','".$timestamp."','".$status."','".$qty."','".$b."',".$total.",'".$p_method."',".$address_id.",".$tax.",'".$tid."','".$player_id."','".$Comment."','".$txt_Address."')");

        if($timesloat!=' '){
            $con->query("INSERT INTO tbl_cupones_aplicados(`cod_cupones`,`Fecha`,`cod_cliente`)values('".$timesloat."','".$Fecha_cupon."','".$cod_cliente."')");
        }
        

        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Pedido realizado correctamente.");

        
}

echo json_encode($returnArr);