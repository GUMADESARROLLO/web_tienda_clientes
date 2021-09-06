<?php 
  require 'include/header.php';
  ?>
  <body data-col="2-columns" class=" 2-columns ">
       <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


     
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
                    <h4 class="card-title">Direccion de Clientes</h4>
					<div class="text-right">
					<a href="user.php" class="btn btn-primary">Lista de Cliente</a>
					</div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								  <th>Nombre</th>
                                    <th>Direccion</th>
									<th>Area</th>
									<th>Referencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $con->query("select * from address where uid=".$_GET['uid']."");

                                while($row = $sel->fetch_assoc())
                                {

                                ?>
                                <tr>

									<td><?php echo $row['Titulo'];?></td>
                                    <td><?php echo $row['Direec'];?></td>
                                     <td><?php echo $row['area'];?></td>
									 <td><?php echo $row['Referecia'];?></td>
									 
                                  
                                   
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




          </div>
        </div>

      

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
  </body>


</html>