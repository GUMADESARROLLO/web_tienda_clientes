<?php 
  require 'include/header.php';
  ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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

    <?php 
		if(isset($_GET['edit'])){


		    $selk = $con->query("select * from product where id=".$_GET['edit']."")->fetch_assoc();
			
			$Unpublish = ($selk['status'] == 0) ? "selected" : "" ;
			$Publish = ($selk['status'] == 1) ? "selected" : "" ;

			$UnPopular = ($selk['popular'] == 0) ? "selected" : "" ;
			$Popular = ($selk['popular'] == 1) ? "selected" : "" ;

		    echo '<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title" id="basic-layout-form">Editar Producto</h4>
							
						</div>
						<div class="card-body">
							<div class="px-3">
								<form class="form" action="#" method="post" enctype="multipart/form-data">
									<div class="form-body">
									
									<div class="form-group">
									   <label for="projectinput6">Buscar Cliente</label>
                                        <select class="custom-select js-select-search" name="frm_cod_cliente" id="slc_edit_user" required>
                                        <option value="'.$selk['pname'].'">'.$selk['sname'].'</option>                                                                                  
                                        </select>
                                    </div>
										<div class="form-group" style="display:none;">
											<input type="text" id="vname" class="form-control"  placeholder="SKU del producto" name="pname" value="'.$selk['sname'].'" required>
										</div>												
												<div class="form-group">
													<label for="projectinput6">Publico?</label>
													<select id="projectinput6" name="ppuborun" class="form-control">
														<option '.$Publish.' value="1">Si</option>
														<option '.$Unpublish.' value="0">No</option>
														
													</select>
												</div>
												
												<div class="form-group">
													<label for="projectinput6">Marcar como producto popular?</label>
													<select id="projectinput6" name="popular" class="form-control">
														
														<option '.$Popular.' value="1">Si</option>
														<option '.$UnPopular.' value="0">No</option>
													</select>
												</div>
												
										
										<div class="form-group">
											<label for="gurl">Descuento (Solo Digitos)</label>
											<input type="text" id="gurl" class="form-control"  name="discount_percentage" placeholder="Ingrese el descuento en porcentaje ej. 5" value="'.$selk['discount'].'" required>
											
										</div>
										
									</div>

									<div class="form-actions">
										
										<button type="submit" name="edit_product" class="btn btn-raised btn-raised btn-primary">
											<i class="fa fa-check-square-o"></i> Guardar
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>';

		}else{

			echo '<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title" id="basic-layout-form">Agregar Producto</h4>
							
						</div>
						<div class="card-body">
							<div class="px-3">
								<form class="form" action="#" method="post" enctype="multipart/form-data">
									<div class="form-body">
									
										<div class="form-group">
                                            <label for="projectinput6">Buscar Cliente</label>
                                            <select class="custom-select js-select-search" name="frm_cod_cliente" required>
                                              <option id="projectinput6"value="0"> - </option>                                        
                                            </select>
                                        </div>
										

										<div class="form-group" style="display:none;" >
											<input type="text" id="vname" class="form-control"  placeholder="SKU del producto" name="pname" required>
										</div>
										
										
												
												
												<div class="form-group">
													<label for="projectinput6">Publico?</label>
													<select id="projectinput6" name="ppuborun" class="form-control">
														
														<option value="0">No</option>
														<option selected="" value="1">Si</option>
													</select>
												</div>
												
												<div class="form-group">
													<label for="projectinput6">Marcar como producto popular?</label>
													<select id="projectinput6" name="popular" class="form-control">
														
														<option value="1">Si</option>
														<option selected="" value="0">No</option>
													</select>
												</div>
												
										
										<div class="form-group">
											<label for="gurl">Descuento (Solo Digitos)</label>
											<input type="text" id="gurl" class="form-control"  name="discount_percentage" placeholder="Ingrese el descuento en porcentaje ej. 5" required>
											
										</div>
										
									</div>

									<div class="form-actions">
										
										<button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
											<i class="fa fa-check-square-o"></i> Guardar
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>';

		}
		?>
    

		<?php
			if(isset($_POST['sub_product'])){


				$pname =  $_POST['frm_cod_cliente'];
                $sname = $_POST['pname'];
				$cid = "0";
				$sid = "0";
				$psdesc = "0";
				$pgms = "0";
				$pprice = "0";				
				$stock = "1";	
				$pimg = "product/thump_1606944282.jpg";	
				$timestamp = date("Y-m-d H:i:s");
				$status = $_POST['ppuborun'];
				$popular = $_POST['popular'];
				$discount = $_POST['discount_percentage'];

				$con->query("insert into product(`pname`,`sname`,`cid`,`sid`,`psdesc`,`pgms`,`status`,`stock`,`pprice`,`popular`,`discount`,`pimg`,`date`)values('".$pname."','".$sname."','".$cid."','".$sid."','".$pgms."','".$psdesc."','".$status."','".$stock."','".$pprice."',".$popular.",".$discount.",'".$pimg."','".$timestamp."')");
			?>
			<script type="text/javascript">
			  $(document).ready(function() {
			    toastr.options.timeOut = 4500; // 1.5s
			    toastr.info('Insert Product Successfully!!');
			    setTimeout(function(){
					window.location.href="productlist.php";
				},1500);
			   
			  });
			 </script>

			<?php 
			 }		
			?>

			<?php
			if(isset($_POST['edit_product'])){

                $sname = $_POST['pname'];
                $pname =  $_POST['frm_cod_cliente'];
				$cid = "0";
				$sid = "0";
				$psdesc = "0";
				$pgms = "0";
				$pprice = "0";				
				$related = "";				
				$stock = "1";	
				$pimg = "product/thump_1606944282.jpg";			
				$status = $_POST['ppuborun'];
				$popular = $_POST['popular'];
				$discount = $_POST['discount_percentage'];



				 $con->query("update product set pname='".$pname."',sname='".$sname."',pimg='".$pimg."',prel='".$related."',popular=".$popular.",discount=".$discount.",cid=".$cid.",sid=".$sid.",psdesc='".$psdesc."',pgms='".$pgms."',pprice='".$pprice."',status=".$status.",stock=".$stock." where id=".$_GET['edit']."");
		
		 
			?>
			<script type="text/javascript">
			  $(document).ready(function() {
			    toastr.options.timeOut = 4500; // 1.5s
			    toastr.info('Update Product Successfully!!');
			    setTimeout(function(){
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

       <script>
           $(document).ready(function() {


               $(".js-select-search").select2({
                   ajax: {
                       url: "api/productos.php",
                       type: "post",
                       dataType: 'json',
                       delay: 250,
                       data: function (params) {
                           return {
                               searchTerm: params.term // search term
                           };
                       },
                       processResults: function (response) {
                           return {
                               results: response
                           };
                       },
                       cache: true
                   }
               });
               $('.js-select-search').on('change', function() {
                   var data = $(".js-select-search option:selected").text();
                   $("#vname").val(data);
               })




           });
       </script>
       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	
  </body>


</html>