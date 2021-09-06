<?php 
require 'db.php';
/*
$data = array(
    "cod_cupones" => "2016",
    "cod_cliente" => "03140",
    "cod_monto"   =>"TOTAL - C$ 2,294.61"
);*/
    //$data = json_decode(file_get_contents('php://input'), true);
    
    
    $cod_cupones             = $_POST['cod_cupones'];
    $cod_cliente             = $_POST['cod_cliente'];
    
    $Info_Cliente            = array();
    $Arr_Articulos_comprados = array([
        "Articulos" => "",
        "Porcent_Cupon" => ""
    ]
    );
    $sqlsrv = new Sqlsrv();


    $query = "SELECT cod_client,pdc FROM user WHERE cod_client='".$cod_cliente."'";
    $resouter = mysqli_query($con, $query);
    while ($row = mysqli_fetch_row($resouter)) {
        $Info_Cliente[] = $row;
    }

    $get_Pro_crecime = $Info_Cliente[0][1];



    if($get_Pro_crecime=="S"){  
        $chek = $con->query(" SELECT * FROM tbl_cupones WHERE cod_cupones='".$cod_cupones."' and Activo ='S' ");
        $row = $chek->fetch_assoc();
        $CompraMinima  = number_format($row['Compra_minima'],2, '.', '');


        //VALIDA QUE EL CUPON NO SE ALLA APLICADO AL MES ACTUAL
        $isCupon = $con->query("SELECT * FROM views_cupones_aplicados T0 WHERE T0.cod_cupones='".$cod_cupones."' and T0.cod_cliente='".$cod_cliente."' AND T0.nMes = MONTH(NOW()) AND T0.nAnno = YEAR(NOW())");

        if($isCupon->num_rows == 0){
            if($chek->num_rows != 0){
                if($row['cod_cupones']=='1308'){    
                    $day = date('N');
                    if($day==5){    
                        $Arr_Articulos_comprados = [];
                        $Str_cadena_Articulos = "";
    
                        $qArticulos_no_facturados="SELECT T1.ARTICULO FROM GMV_mstr_articulos T1  WHERE
                        T1.ARTICULO NOT IN ( SELECT T0.ARTICULO FROM Softland.dbo.VtasTotal_UMK T0 WHERE T0.[Cod. Cliente]= '".$cod_cliente."' GROUP BY T0.ARTICULO) AND EXISTENCIA > 30 
                        ORDER BY CALIFICATIVO ASC";
    
                        $qNoFacturado = $sqlsrv->fetchArray($qArticulos_no_facturados, SQLSRV_FETCH_ASSOC);
        
                        foreach ($qNoFacturado as $fila) {
                            $Str_cadena_Articulos .= "'".$fila['ARTICULO'] ."'," ;
                        }
    
                        $a['Articulos']     = "Custom";
                        $a['Porcent_Cupon'] =  substr($Str_cadena_Articulos,0,-1);
                        $a['Cantidad_Cupon'] = $CompraMinima;
                        $a['Cupon_cat']      = $row['porcentaje'];;
                        $Arr_Articulos_comprados[] = $a;
    
                    }else{                    
                        
                        $returnArr = array(
                            "ResponseCode"=>"401",
                            "ResultData"=> $Arr_Articulos_comprados,
                            "Result"=>"false",
                            "ResponseMsg"=>"VÁLIDO PARA LOS DÍAS VIERNES"
                        ); 
                        echo json_encode($returnArr);
                        
                    }
                }else{
    
                    $qArticulos_Descuento ="SELECT TOP 1 *  FROM gmv_cliente_cuponera WHERE Cod_Cupon='".$cod_cupones."'";
                    $qFacturado = $sqlsrv->fetchArray($qArticulos_Descuento, SQLSRV_FETCH_ASSOC);
        
                    $Arr_Articulos_comprados = [];
                    if($sqlsrv->getRowsAffected() != 0){
                        foreach ($qFacturado as $fila) {
                            $a['Articulos']      = $fila['ARTICULO'];
                            $a['Porcent_Cupon']  = $row['porcentaje'];
                            $a['Cantidad_Cupon'] = $CompraMinima;
                            $a['Cupon_cat']      = $fila['ID_CLAS_3'];
                            $Arr_Articulos_comprados[] = $a;
                        }
                    }else{                    
                        $a['Articulos']     = "ALL";
                        $a['Porcent_Cupon'] =  $row['porcentaje'];
                        $a['Cantidad_Cupon'] = $CompraMinima;
                        $a['Cupon_cat']      = "";
                        $Arr_Articulos_comprados[] = $a;
                    }  
                    
                    $returnArr = array(                
                        "ResponseCode"=>"200",
                        "ResultData"=> $Arr_Articulos_comprados,
                        "Result"=>"true" ,
                        "ResponseMsg"=>"Cupon Valido"
                    ); 
                    echo json_encode($returnArr);
                }
    
            }else{
                $returnArr = array(
                    "ResponseCode"=>"401",
                    "ResultData"=> $Arr_Articulos_comprados,
                    "Result"=>"false",
                    "ResponseMsg"=>"Este Cupon no existe"
                ); 
                echo json_encode($returnArr);
            }
        }else{
            $returnArr = array(
                "ResponseCode"=>"401",
                "ResultData"=> $Arr_Articulos_comprados,
                "Result"=>"false",
                "ResponseMsg"=>"Este Cupon ya fue aplicado este mes"
            ); 
            echo json_encode($returnArr);
        }

        
        
        
    }else{
        $returnArr = array(
            "ResponseCode"=>"401",
            "ResultData"=> $Arr_Articulos_comprados,
            "Result"=>"false",
            "ResponseMsg"=>"No puede aplicar este cupon"
        );
        echo json_encode($returnArr);
    }

