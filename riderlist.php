<?php 
  require 'include/header.php';
  ?>
  <body data-col="2-columns" class=" 2-columns ">
       <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <?php include('main.php'); ?>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col">
                      <h4 class="card-title">Lista de Repartidor</h4>
                    </div>
                    <div class="col ">
                      <a href="add_rider.php" class=" float-right btn btn-raised btn-raised btn-primary "> Agregar</a>
                    </div>
                  </div>

                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                   
                                    <th>Nombre</th>
                                   <th>Tel.</th>
								    <th>Email</th>
									 <th>Area</th>
									  <th>Direccion</th>
									   <th>Status</th>
									   <th>App Status(On/Off)</th>
									    <th>Rechazar</th>
										<th>Aceptados</th>
										<th>Completado</th>
										
                                    <th>Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jj = $con->query("select * from rider");
                                $i=0;
                                while($rkl = $jj->fetch_assoc())
                                {
                                    $i = $i + 1;
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    
                                    <td><?php echo $rkl['name'];?></td>
                                   <td><?php echo $rkl['mobile'];?></td>
								   <td><?php echo $rkl['email'];?></td>
								   <td><?php $ad = $con->query("select * from area_db where id=".$rkl['aid']."")->fetch_assoc(); echo $ad['name'];?></td>
 <td><?php echo $rkl['address'];?></td> 								  
								  <td><?php if($rkl['status'] == 1){echo 'Activo';}else {echo 'Inactivo';}?></td> 
								    <td><?php if($rkl['a_status'] == 1) {echo 'On';}else {echo 'Off';}?></td> 
								   <td><?php echo $rkl['reject'];?></td>
								   <td><?php echo $rkl['accept'];?></td>
								   <td><?php echo $rkl['complete'];?></td>
                                    <td>
									<?php if($rkl['status'] == 0) {?>
									<a href="?status=1&rid=<?php echo $rkl['id'];?>">	<button class="btn btn-success"   data-original-title="" title="">
                                          Marcar Activo
                                        </button></a>
									<?php } else { ?>
								<a	href="?status=0&rid=<?php echo $rkl['id'];?>">	<button class="btn btn-danger"  href="?status=0&rid=<?php echo $rkl['id'];?>" data-original-title="" title="">
                                            Marcar Inactivo
                                        </button>
										</a>
									<?php } ?>
										</td>
                                   
                                </tr>
                               <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
if(isset($_GET['status']))
{
$status = $_GET['status'];
$id = $_GET['rid'];

  $con->query("update rider set status=".$status." where id=".$id."");  
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Delivery Boy Status Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="riderlist.php";
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
   
    <?php 
  require 'include/js.php';
  ?>
   
  </body>


</html>