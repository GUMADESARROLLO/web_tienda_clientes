<?php 
  require 'include/header.php';
     require 'api/db.php';
  $sqlsrv = new Sqlsrv();
  $query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.Clasificacion_1, COUNT(T0.ID_CLAS_1) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 NOT IN (7)  AND STOCK > 0 GROUP BY T0.ID_CLAS_1,T0.Clasificacion_1 ", SQLSRV_FETCH_ASSOC);


  $found_key = array_search('1', array_column($query, 'ID_CLAS_1'));
  $ID_Post = $query[$found_key]['Clasificacion_1'];
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
                      <h4 class="card-title">Lista de Banners</h4>
                    </div>
                    <div class="col ">
                      <a href="banner.php" class=" float-right btn btn-raised btn-raised btn-primary "> Agregar</a>
                    </div>
                  </div>

                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                    <?php print_r($ID_Post);?>
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>No.</th>
                                   
                                    <th>Imagen</th>
                                    <th>Banner Categoria</th>
                                    <th>Publico</th>
                                    <th>Acccion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jj = $con->query("select * from banner");

                                while($rkl = $jj->fetch_assoc())
                                {
                                    $Estados = ($rkl['Status'] == 0) ? "NO" : "SI" ;
                                ?>
                                <tr>
                                    <td><?php echo $rkl['id'];?></td>
                                    
                                    <td><img src="<?php echo $rkl['bimg'];?>" width="100" height="100"/></td>
                                    <td><?php
                                        
                                        if($rkl['cid'] == '0') {
                                          echo 'N/D';
                                        } else {
                                          $found_key = array_search($rkl['cid'], array_column($query, 'ID_CLAS_1'));
                                            $ID_Post = $query[$found_key]['Clasificacion_1'];
                                            echo $ID_Post;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $Estados;?></td>

                                    <td>

									
										<a class="primary"  href="banner.php?edit=<?php echo $rkl['id'];?>" data-original-title="" title="">
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
    $con->query("delete from banner  where id=".$_GET['dele']."");
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('selected banner deleted successfully.');
   setTimeout(function()
	{
		window.location.href="bannerlist.php";
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