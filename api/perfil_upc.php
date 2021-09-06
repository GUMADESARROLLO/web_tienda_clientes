<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$uid = $data['uid'];

if($uid == ''){
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}else {
    $sqlsrv = new Sqlsrv();
    $Ventas_por_mes         = array();
	$Articulos_comprados    = array(); 
	$Articulos_no_comprados = array();
    $Info_Cliente = array();

    $Venta_Anual            = 0;
    $get_meta_cliente       = 0;
    $Monto_Optimo           = 0;
    $Pocentaje_cumplimiento = 0;
    
    $set_img ="http://186.1.15.167:8448/tnd/product/ND.png";

    $Item_imagenes = array();


    $query = "SELECT p.product_sku,p.product_image FROM tbl_product p ";
    $resouter = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_row($resouter)) {
        $Item_imagenes[] = $row;
    }


    

    // HISTORIAL DE ARTICULOS FACTURADOS POR EL CLIENTE
    $qArticulos_Comprados ="SELECT
	T0.ARTICULO,
	T0.DESCRIPCION,
	SUM ( T0.CANTIDAD ) AS Cantidad,
	SUM ( T0.Venta ) AS Venta 
    FROM
        Softland.dbo.VtasTotal_UMK T0 
    WHERE
        T0.[Cod. Cliente] = '".$uid."' 
        AND T0.ARTICULO NOT LIKE '%-B' 
    GROUP BY
        T0.ARTICULO,
        T0.DESCRIPCION";

    $qFacturado = $sqlsrv->fetchArray($qArticulos_Comprados, SQLSRV_FETCH_ASSOC);
    
    foreach ($qFacturado as $fila) {        

        $found_key = array_search($fila['ARTICULO'], array_column($Item_imagenes, 'product_sku'));

        if($found_key!=null){
            $set_img = "http://186.1.15.166:8448/gmv3/upload/product/".$Item_imagenes[found_key][1];
        }
        

        $a['Articulos']     = $fila['ARTICULO'];
        $a['Descripcion']   = $fila['DESCRIPCION'];
        $a['Cantidad']      = number_format($fila['Cantidad'],2, '.', '');
        $a['Venta']         = number_format($fila['Venta'],2, '.', '');
        $a['product_image'] = $set_img;
        $Articulos_comprados[] = $a;
    }

    


    // ARTICULOS QUE NO A FACTURADO EL CLIENTE
    $qArticulos_no_facturados="SELECT
        * 
    FROM
        GMV_mstr_articulos T1 
    WHERE
        T1.ARTICULO NOT IN ( SELECT T0.ARTICULO FROM Softland.dbo.VtasTotal_UMK T0 WHERE T0.[Cod. Cliente]= '".$uid."' GROUP BY T0.ARTICULO) 
        AND EXISTENCIA > 30 
    ORDER BY
        CALIFICATIVO ASC";


    $qNoFacturado = $sqlsrv->fetchArray($qArticulos_no_facturados, SQLSRV_FETCH_ASSOC);
    
    foreach ($qNoFacturado as $fila) {        
        $b['Articulos']     = $fila['ARTICULO'];
        $b['Descripcion']   = $fila['DESCRIPCION'];
        $b['Cantidad']      = number_format($fila['EXISTENCIA'],2, '.', '');
        $b['Venta']         = "";
        $b['product_image'] = $set_img;
        $Articulos_no_comprados[] = $b;
    }

    //HISTORIAL DE COMPTRAS DEL CLIENTE DURANTE EL AÑO ACTUAL
    $qVentas_anual ="SELECT
	T0.Mes,
	SUM ( T0.Venta ) AS Venta 
    FROM
        Softland.dbo.VtasTotal_UMK T0 
    WHERE
        T0.[Cod. Cliente] = '".$uid."' 
        AND T0.ARTICULO NOT LIKE '%-B' and T0.[Año]= YEAR(GETDATE())
        GROUP BY T0.nMes,T0.Mes
        ORDER BY T0.nMes;";

    $qVentaAnual = $sqlsrv->fetchArray($qVentas_anual, SQLSRV_FETCH_ASSOC);
        
    foreach ($qVentaAnual as $fila) {

        $Valor = number_format($fila['Venta'],2, '.', '');

        $c['Mes']           = $fila['Mes'];        
        $c['Cantidad']      = $Valor;
        $Ventas_por_mes[]   = $c;

        $Venta_Anual = $Venta_Anual + $Valor ;
    }


    $array_jeyson = array(
        'Facturado_anual'       =>$Ventas_por_mes,
        'Articulos_facturado'   =>$Articulos_comprados,
        'Articulos_no_facturado'=>$Articulos_no_comprados
    );
    
    $query = "SELECT Meta FROM tbl_cliente_programa WHERE cod_cliente='".$uid."'";
    $resouter = mysqli_query($con, $query);
    while ($row = mysqli_fetch_row($resouter)) {
        $Info_Cliente[] = $row;
    }

        $get_meta_cliente = number_format($Info_Cliente[0][0] ,2, '.', '');
    
    $Mes_actual = date('m');

    $Monto_Optimo = $get_meta_cliente * $Mes_actual;

    //$Pocentaje_cumplimiento  = number_format((($Venta_Anual / $Monto_Optimo )  - 1 ) * 100);
    //$Pocentaje_cumplimiento  = number_format(((($get_meta_cliente * 12 ) / $Venta_Anual )  - 1 ) * 100);

    $Pocentaje_cumplimiento  = number_format( ($Venta_Anual * 100) / ($get_meta_cliente * 12) );
    
	$returnArr = array(
        "ResponseCode"  =>"200",
        "Result"        =>"true",
        "ResponseMsg"   =>"Data Get Successfully!",
        "Cliente_Meta"  => $get_meta_cliente * 12,
        "Cliente_Venta" => $Venta_Anual,
        "Porce_cump"    => $Pocentaje_cumplimiento,
        "ResultData"    => $array_jeyson
    );

    echo json_encode($returnArr);

    

} 
