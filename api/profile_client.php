<?php 
require 'db.php';
header('Content-type: text/json');
$sqlsrv = new Sqlsrv();


if($_GET['get_perfil_user'] != '')
{
    $Client = $_GET['get_perfil_user'];
    $dta = array(); $i=0;

    $qCliente   = $sqlsrv->fetchArray("SELECT * FROM GMV_Clientes WHERE CLIENTE='".$Client."' ", SQLSRV_FETCH_ASSOC);
    $dta[$i]['NombreCliente']   = $qCliente[0]['NOMBRE'];
    $dta[$i]['Limite']          = number_format($qCliente[0]['CREDITO'],2);
    $dta[$i]['Saldo']           = number_format($qCliente[0]['SALDO'],2);
    $dta[$i]['Disponible']      = number_format($qCliente[0]['DISPONIBLE'],2);
    $dta[$i]['Moroso']          = $qCliente[0]['MOROSO'];
    $dta[$i]['NoVencidos']      = number_format(0,2);
    $dta[$i]['Dias30']          = number_format(0,2);
    $dta[$i]['Dias60']          = number_format(0,2);
    $dta[$i]['Dias90']          = number_format(0,2);
    $dta[$i]['Dias120']         = number_format(0,2);
    $dta[$i]['Mas120']          = number_format(0,2);
    $dta[$i]['FACT_PEND']       = "";



    $query      = $sqlsrv->fetchArray("SELECT * FROM GMV_PERFILES_CLIENTE WHERE CLIENTE='".$Client."' ", SQLSRV_FETCH_ASSOC);

    if(count($query) != 0){
        foreach ($query as $key) {

            $dta[$i]['NoVencidos']  = number_format($key['NoVencidos'],2);
            $dta[$i]['Dias30']      = number_format($key['Dias30'],2);
            $dta[$i]['Dias60']      = number_format($key['Dias60'],2);
            $dta[$i]['Dias90']      = number_format($key['Dias90'],2);
            $dta[$i]['Dias120']     = number_format($key['Dias120'],2);
            $dta[$i]['Mas120']      = number_format($key['Mas120'],2);
            $dta[$i]['FACT_PEND']   = $key['FACT_PEND'];



            $i++;

        }
       $returnArr = array("data"=>$dta,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
    }else{
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Product  Not Found!");
    }

echo json_encode($dta);
}else{
    echo "dont touch";
}
