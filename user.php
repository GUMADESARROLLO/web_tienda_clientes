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
                            <h4 class="card-title">Usuarios</h4>
                        </div>
                        <div class="col ">
                            <a href="userAdd.php" class=" float-right btn btn-raised btn-raised btn-primary "> Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								    <th>No.</th>
                                    <th>Cod. Cliente</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
									<th>Code de Pais</th>
                                    <th>Tel.</th>
                                   <th>contraseña</th>
									 <th>Estado actual</th>
                                    <th>Status</th>
                                    <th>Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $con->query("select * from user");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {

                                ?>
                                <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['cod_client'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
									<td><?php echo $row['ccode'];?></td>
                                    <td><?php echo $row['mobile'];?></td>
                                    <td><?php echo $row['password'];?></td>
									 <td><?php if($row['status'] == 1){echo 'Active';}else{echo 'Deactive';}?></td>
                                    <td><?php if($row['status'] == 1) {?>

                                    <a href="?status=0&sid=<?php echo $row['id'];?>"><button class="btn btn-danger"> Deshabilitar</button></a>
                                    <?php }else {?>
                                    <a href="?status=1&sid=<?php echo $row['id'];?>"><button class="btn btn-success"> Habilitar</button></a>
                                    <?php } ?>
                                    </td>
                                    <td>
                                        <a class="primary" href="userAdd.php?edit=<?php echo $row['id'];?>" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
									<a class="danger" href="?dele=<?php echo $row['id'];?>" data-original-title="" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>
									&nbsp;&nbsp;
										<a class="info" href="address.php?uid=<?php echo $row['id'];?>" data-original-title="" title="">
                                           <i class="fa fa-map-marker font-medium-3"></i>
                                        </a>
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
$id = $_GET['sid'];

  $con->query("update user set status=".$status." where id=".$id."");  
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('User Status Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="user.php";
	},1500);
    
  });
  </script>
  <?php
}
if(isset($_GET['dele']))
{
$con->query("delete from user where id=".$_GET['dele']."");
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('selected user deleted successfully.');
    setTimeout(function()
	{
		window.location.href="user.php";
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
    <style>
        table
        {
            font-size:13px;
        }
    </style>
    <!-- END PAGE LEVEL JS-->
  </body>


</html>