<?php 
  require 'include/header.php';
    require 'api/db.php';
  $sqlsrv = new Sqlsrv();
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

    
    
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Agregar Banner</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
					    <?php 
					    if(isset($_GET['edit']))
					    {
					        $bdata = $con->query("select * from banner where id=".$_GET['edit']."")->fetch_assoc();
                            $Unpublish = ($bdata['Status'] == 0) ? "selected" : "" ;
                            $Publish = ($bdata['Status'] == 1) ? "selected" : "" ;
					    ?>
					    <form class="form" action="#" method="post" enctype="multipart/form-data">
							<div class="form-body">

								
								<div class="form-group">
									<label for="cname">Banner Imagen</label>
									<input type="file" id="pimg" class="form-control"  placeholder="Ingrese Imagen del Banner" name="pimg">
									<img src="<?php echo $bdata['bimg'];?>" width="100" height="100"/>
								</div>

                                <?php

                                echo '<div class="form-group">
                                    <label for="projectinput6">Publico?</label>
                                    <select id="projectinput6" name="publico" class="form-control">
                                        <option '.$Publish.' value="1">Si</option>
                                        <option '.$Unpublish.' value="0">No</option>

                                    </select>
                                </div>';
								
                                 ?>		<div class="form-group">
									<label for="cname">Vincular con categoría?(Opcional)</label>
									<select class="form-control" name="scat">
									    <option value="0">...</option>
									    <?php
									    $query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.Clasificacion_1, COUNT(T0.ID_CLAS_1) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 NOT IN (7)  AND STOCK > 0 GROUP BY T0.ID_CLAS_1,T0.Clasificacion_1 ", SQLSRV_FETCH_ASSOC);
										foreach ($query as $fila) {									
									    ?>
									    <option value="<?php  echo $fila['ID_CLAS_1'];?>" <?php if($bdata['cid'] == $fila['ID_CLAS_1']){echo 'selected';} ?>><?php echo $fila['Clasificacion_1'];?></option>
									    <?php } ?>
									</select>
								</div>	

								
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="edit_product" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Guardar
								</button>
							</div>
						</form>
						
					    <?php 
					    if(isset($_POST['edit_product'])){
		                    $target_dir = "banner/";
							$fname = uniqid().$_FILES["pimg"]["name"];
							$url = $target_dir.$fname;
                            $target_file = $target_dir . basename($fname);
                            $cid = $_POST['scat'];
                            $public = $_POST['publico'];
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            if($_FILES["pimg"]["name"] == '')  {
                                $con->query("update banner set cid=".$cid.",Status=".$public." where id=".$_GET['edit']."");

                        ?>
		 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    toastr.info('Update Banner Successfully!!!');
    setTimeout(function()
	{
		window.location.href="bannerlist.php";
	},1500);
  });
  </script>
		<?php 
}
else 
{
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    
       ?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('Sorry, only JPG, JPEG, PNG  files are allowed.');
    setTimeout(function()
	{
		window.location.href="banner.php?edit=<?php echo $_GET['edit'];?>";
	},1500);
  });
  </script>
	<?php  
    }
    else 
    {
    
    $con->query("update banner set cid=".$cid.",bimg='".$target_file."' where id=".$_GET['edit']."");
    move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);
?>
		 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    toastr.info('Update Banner Successfully!!!');
    setTimeout(function()
	{
		window.location.href="bannerlist.php";
	},1500);
  });
  </script>
		<?php 
    }
}

	
					    }
					        
					    }
					    else 
					    {
					    ?>
						<form class="form" action="#" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Imagen</label>
									<input type="file" id="pimg" class="form-control"  placeholder="Ingrese Imagen del Banner" name="pimg" required>
								</div>

                                <div class="form-group">
                                    <label for="projectinput6">Publico?</label>
                                    <select id="projectinput6" name="publico" class="form-control">

                                        <option value="0">No</option>
                                        <option selected="" value="1">Si</option>
                                    </select>
                                </div>
								
                                		<div class="form-group">
									<label for="cname">Vincular con categoría?(Opcional)</label>
									<select class="form-control" name="scat">
									    <option value="0">Categoria</option>
									    <?php
									    $query = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.Clasificacion_1, COUNT(T0.ID_CLAS_1) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 NOT IN (7)  AND STOCK > 0 GROUP BY T0.ID_CLAS_1,T0.Clasificacion_1 ", SQLSRV_FETCH_ASSOC);
										foreach ($query as $fila) {
									    ?>
									    <option value="<?php  echo $fila['ID_CLAS_1'];?>"><?php echo $fila['Clasificacion_1'];?></option>
									    <?php } ?>
									</select>
								</div>	

								
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Guardar
								</button>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		if(isset($_POST['sub_product'])){
		    $target_dir = "banner/";
			$fname = uniqid().$_FILES["pimg"]["name"];
			$url = $target_dir.$fname;
            $target_file = $target_dir . basename($fname);
            $cid = $_POST['scat'];
            $public = $_POST['publico'];
		    $con->query("insert into banner(`bimg`,`cid`,`Status`)values('".$url."',".$cid.",".$public.")");
		    move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);
		?>
		 <script type="text/javascript">
            $(document).ready(function() {
            toastr.options.timeOut = 4500; // 1.5s
            toastr.info('Insert New Banner Successfully!!!');
            });
        </script>
		<?php
		    }
		?>
	</div>




<script>
// Code to get duration of audio /video file before upload - from: http://coursesweb.net/

//register canplaythrough event to #audio element to can get duration
var f_duration =0;  //store duration
document.getElementById('audio').addEventListener('canplaythrough', function(e){
  //add duration in the input field #f_du
  f_duration = Math.round(e.currentTarget.duration);
  document.getElementById('f_du').value = f_duration;
  URL.revokeObjectURL(obUrl);
});

//when select a file, create an ObjectURL with the file and add it in the #audio element
var obUrl;
document.getElementById('f_up').addEventListener('change', function(e){
  var file = e.currentTarget.files[0];
  //check file extension for audio/video type
  if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
    obUrl = URL.createObjectURL(file);
    document.getElementById('audio').setAttribute('src', obUrl);
  }
});
</script>



          </div>
        </div>

         

      </div>
    </div>
    
  <?php 
  require 'include/js.php';
  ?>
   
    
  </body>


</html>