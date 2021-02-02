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
                      <h4 class="card-title">Lista de Productos</h4>
                    </div>
                    <div class="col ">
                      <a href="product.php" class=" float-right btn btn-raised btn-raised btn-primary "> Agregar</a>
                    </div>
                  </div>


                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Cod. Articulo</th>
                                    <th>Descripción</th>
                                    <th>Status</th>
                                    <th>Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jj = $con->query("select * from product order by id desc");
                                $i=0;
                                while($rkl = $jj->fetch_assoc())
                                {

                                ?>
                                <tr>
                                    <td><?php echo $rkl['pname'];?></td>
                                    <td><?php echo $rkl['sname'];?></td>
									
                                    <td><?php if($rkl['status'] == 1) {echo 'Publish';}else{echo 'Unpublish';} ?></td>
                                    <td>
									<a class="primary" href="product.php?edit=<?php echo $rkl['id'];?>" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
										
									<a class="danger" data-original-title=""  href="?dele=<?php echo $rkl['id'];?>" title="">
                                            <i class="ft-trash font-medium-3"></i>
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
if(isset($_GET['dele']))
{
$con->query("delete from product  where id=".$_GET['dele']."");
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('selected product deleted successfully.');
    setTimeout(function()
	{
		window.location.href="productlist.php";
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