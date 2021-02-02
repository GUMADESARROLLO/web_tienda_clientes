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


		    $selk = $con->query("select * from user where id=".$_GET['edit']."")->fetch_assoc();
			
			$Unpublish = ($selk['status'] == 0) ? "selected" : "" ;
			$Publish = ($selk['status'] == 1) ? "selected" : "" ;



		    echo '<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title" id="basic-layout-form">Editar Usuario</h4>
							
						</div>
						<div class="card-body">
							<div class="px-3">
								<form class="form" action="#" method="post" enctype="multipart/form-data">
									<div class="form-body">
									
									<div class="form-group">
									   <label for="projectinput6">Buscar Cliente</label>
                                        <select class="custom-select js-select-search" name="frm_cod_cliente" id="slc_edit_user" required>
                                        <option value="'.$selk['cod_client'].'">'.$selk['name'].'</option>                                                                                  
                                        </select>
                                    </div>
									
									<div class="form-group" style="display: none">
											<input type="text" id="vname" class="form-control"  placeholder="Nombre del propietario del local" name="frm_full_name" value="'.$selk['name'].'" required>
										</div>
										
										<div class="form-group">
											<label for="cEmail">Correo Electronico:</label>
											<input type="text" id="vEmail" class="form-control"  placeholder="Correo del propietario" name="frm_email" value="'.$selk['email'].'"required>
										</div>
																						
										<div class="form-group">
											<label for="cEmail">Numero De telefono:</label>
											<input type="text" id="vPhone" class="form-control"  placeholder="Telefono del propietario" name="frm_phone" value="'.$selk['mobile'].'"required>
										</div>	
										
										<div class="form-group">
											<label for="gurl">Difite una contraseña</label>
											<input type="password" id="Password" class="form-control"  placeholder="Ingrese el numero telefonico"  name="frm_password" value="'.$selk['password'].'" required>
										</div>
										<div class="form-group">
											<label for="projectinput6">Activo</label>
											<select id="projectinput6" name="frm_activo" class="form-control">		
											    <option '.$Publish.' value="1">Si</option>
												<option '.$Unpublish.' value="0">No</option>
										    </select>
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
							<h4 class="card-title" id="basic-layout-form">Nuevo Usuario</h4>
							
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

										<div class="form-group" style="display: none">
											<input type="text" id="vname" class="form-control"  placeholder="Nombre del propietario del local" name="frm_full_name" required>
										</div>
										
										<div class="form-group">
											<label for="cEmail">Correo Electronico:</label>
											<input type="text" id="vEmail" class="form-control"  placeholder="Correo del propietario" name="frm_email" required>
										</div>
																						
										<div class="form-group">
											<label for="cEmail">Numero De telefono:</label>
											<input type="text" id="vPhone" class="form-control"  placeholder="Telefono del propietario" name="frm_phone" required>
										</div>	
										
										<div class="form-group">
											<label for="gurl">Difite una contraseña</label>
											<input type="password" id="Password" class="form-control"  placeholder="Ingrese la contraseña"  name="frm_password" required>
										</div>
										<div class="form-group">
											<label for="projectinput6">Activo</label>
											<select id="projectinput6" name="frm_activo" class="form-control">		
												<option value="0">No</option>
											    <option selected="" value="1">Si</option>
										    </select>
										</div>
										
									</div>

									<div class="form-actions">
										
										<button type="submit" name="sub_Cliente" class="btn btn-raised btn-raised btn-primary">
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
			if(isset($_POST['sub_Cliente'])){

				$pname = $_POST['frm_full_name'];
                $pimei = "";
                $pemail = $_POST['frm_email'];
                $pccode = "+505";
                $pmobile = $_POST['frm_phone'];
				$prdate = date("Y-m-d H:i:s");
				$ppassword = $_POST['frm_password'];
                $pstatus = $_POST['frm_activo'];
                $pcod_cliente = $_POST['frm_cod_cliente'];
                $ppin = "";
				$paid = "1";

				$con->query("insert into user(`name`,`cod_client`,`imei`,`email`,`ccode`,`mobile`,`rdate`,`password`,`status`,`pin`,`aid`)values('".$pname."','".$pcod_cliente."','".$pimei."','".$pemail."','".$pccode."','".$pmobile."','".$prdate."','".$ppassword."','".$pstatus."','".$ppin."','".$paid."')");
			?>
			<script type="text/javascript">
			  $(document).ready(function() {
			    toastr.options.timeOut = 4500; // 1.5s
			    toastr.info('Exitosamente');
			    setTimeout(function(){
					window.location.href="user.php";
				},1500);
			   
			  });
			 </script>

			<?php 
			 }		
			?>

			<?php
			if(isset($_POST['edit_product'])){
                $pcod_cliente = $_POST['frm_cod_cliente'];
                $pname = $_POST['frm_full_name'];
                $pimei = "";
                $pemail = $_POST['frm_email'];
                $pccode = "+505";
                $pmobile = $_POST['frm_phone'];

                $ppassword = $_POST['frm_password'];
                $pstatus = $_POST['frm_activo'];

                $con->query("update user set name='".$pname."',cod_client='".$pcod_cliente."',imei='".$pimei."',email='".$pemail."',ccode='".$pccode."',mobile='".$pmobile."',password='".$ppassword."',status='".$pstatus."' where id=".$_GET['edit']."");
		
		 
			?>
			<script type="text/javascript">
			  $(document).ready(function() {
			    toastr.options.timeOut = 4500; // 1.5s
			    toastr.info('Exitosamente!!');
			    setTimeout(function(){
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
    

	<script>
        $(document).ready(function() {


            $(".js-select-search").select2({
                ajax: {
                    url: "api/clientes.php",
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
	
  </body>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</html>