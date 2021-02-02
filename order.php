<?php
    require 'include/header.php';
    $getkey = $con->query("select * from setting")->fetch_assoc();
    define('ONE_KEY',$getkey['one_key']);
    define('ONE_HASH',$getkey['one_hash']);
    define('r_key',$getkey['r_key']);
    define('r_hash',$getkey['r_hash']);

    $sel = $con->query("SELECT T0.id,T0.order_date,T1.cod_client,T1.name,T0.status,T0.p_method,T0.player_id FROM orders T0 INNER JOIN USER T1 ON T0.uid = T1.id WHERE T0.STATUS = 'pendiente ' ORDER BY T0.id DESC");


?>

        <style>


            </style>
              <body data-col="2-columns" class=" 2-columns ">

                <div class="layer"></div>
                    <div class="wrapper">';
                        <?php include('main.php'); ?>
                        <div class="main-panel">
                        <div class="main-content">
                            <div class="content-wrapper">
                            <section id="dom">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Pedidos</h4>
                                            </div>
                                             <div class="card-body collapse show">
                                                <div class="card-block card-dashboard">
                                                    <table class="table table-striped" id="example">
                                                    <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Fecha</th>
                                                        <th>Cliente</th>
                                                        <th>Nombre</th>
                                                        <th>ESTADO</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                 <tbody>
                                                 <?php
                                                     while($row = $sel->fetch_assoc()){

                                                         $pid=  substr("00000000", strlen($row['id'])).$row['id'];
                                                         echo '<tr>
                                                                    <td>'.$pid.'</td>
                                                                    <td>'.$row['order_date'].'</td>
                                                                    <td>'.$row['cod_client'].'</td>
                                                                    <td>'.$row['name'].'</td>
                                                                    <td>'.$row['status'].'</td>
                                                                    
                                                                    <td style="text-align: center">
                                                                        <a class="btn btn-primary preview_d" data-id='.$row['id'].' data-toggle="modal" data-target="#myModal" href="!#" data-original-title="" title="" aria-label="Ver Pedido">
                                                                            <i class="fa fa-eye fa-lg"></i> Revisar</a>
                                                                        </a>
                                
                                                                        <a class="btn btn-primary" href="?status=completado&id='.$row['id'].'&player_id='.$row['player_id'].'" aria-label="Procesar">
                                                                            <i class="fa fa-check-circle fa-lg"></i> Procesar</a>
                                
                                                                        </a>
                                
                                                                        <a class="btn btn-danger" href="?dele='.$row['id'].'" aria-label="Borrar">
                                                                            <i class="fa fa-trash-o fa-lg"></i> Borrar</a>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                ';
                                                     }
                                                 ?>
                                                 </tbody>

                                                    </table>
                                                </div>
                                             </div>

                                        </div>
                                    </div>
                                </div>
                            </section>

                                <?php
                                if(isset($_GET['status'])){

                                    $status     = $_GET['status'];
                                    $id         = $_GET['id'];
                                    $userid     = $_GET['player_id'];

                                    $con->query("update orders set status='".$status."' where id=".$id."");
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            var id_order = "<?php echo $id; ?>";

                                            var vartitle = "Su Pedido Nº " + id_order + " fue procesado.";
                                            var varcontent = "Muchas gracias";
                                            var varurl = "no_url";
                                            var id_dispositivo = "<?php echo $userid; ?>";


                                            $.ajax({
                                                type: "POST",
                                                url: "./api/notification_api.php",
                                                data: {
                                                    "single":"",
                                                    title: vartitle,
                                                    content: varcontent,
                                                    url: varurl,
                                                    devicesid: id_dispositivo
                                                },
                                                dataType: "json",
                                                success: function(result) {


                                                }


                                            });
                                            toastr.options.timeOut = 4500; // 1.5s
                                            toastr.info('Order Status Update Successfully!!');

                                            setTimeout(function(){
                                                window.location.href="order.php";
                                            },1500);

                                        });
                                    </script>
                                    <?php
                                }
                                ?>
                                <?php
                                if(isset($_GET['dele'])){
                                    $con->query("delete from orders where id=".$_GET['dele']."");
                                    ?>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            toastr.options.timeOut = 4500; // 1.5s
                                            toastr.error('selected order deleted successfully.');
                                            setTimeout(function(){
                                                window.location.href="order.php";
                                            },1500);
                                        });
                                    </script>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>

                <?php require 'include/js.php';?>

              </body>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">


        <div class="modal-content">
            <div class="modal-header">
                <h4>RESUMEN</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p_data">

            </div>

        </div>

    </div>
</div>
<script>
    $('#example').DataTable();
</script>
<script>
    $(document).ready(function()
    {
        $("#example").on("click", ".preview_d", function()
        {
            var id = $(this).attr('data-id');
            $.ajax({
                type:'post',
                url:'pdata.php',
                data:
                    {
                        pid:id
                    },
                success:function(data)
                {
                    $(".p_data").html(data);
                }
            });
        });
    });
</script>
<script>
    function printDiv() {
        var divToPrint=document.getElementById('divprint');
        var newWin=window.open('','Print-Window');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'table th, table td {' +
            'border:1px solid #000;' +
            'padding:0.5em;' +
            '}' +
            '.list-group { ' +
            'display: flex; ' +
            'flex-direction: column; ' +
            'padding-left: 0; ' +
            'margin-bottom: 0; ' +
            '}' +
            '.list-group-item {' +
            ' position: relative;' +
            'display: block;' +
            'padding: 0.75rem 1.25rem;' +
            'margin-bottom: -1px;' +
            'background-color: #fff;' +
            'border: 1px solid rgba(0, 0, 0, 0.125);' +
            '}' +

            '.float-right {' +
            'float: right !important;' +
            '}' +

            '</style>';

        newWin.document.open();
        htmlToPrint += divToPrint.innerHTML;
        newWin.document.write('<html><body onload="window.print()">'+htmlToPrint+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},1);

    }
</script>



</html>
