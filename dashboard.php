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

<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Escritorio</h4>
					
				</div>
				<div class="card-body" style="padding:10px;">
				   <div class="row" matchheight="card">
    
    
    <div class="col-xl-3 col-lg-6 col-12" style="display: none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success"><?php echo $con->query("select * from product")->num_rows;?></h3>
                <span>Productos</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-basket-loaded success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12" style="display:none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 warning"><?php echo $con->query("select * from area_db")->num_rows;?></h3>
                <span>Total Area</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-pie-chart warning font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12" style="display:none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary"><?php echo $con->query("select * from timeslot")->num_rows;?></h3>
                <span>Total Timesloat</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-hourglass primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12" style="display: none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary"><?php echo $con->query("select * from banner")->num_rows;?></h3>
                <span>Banners</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-screen-desktop primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
     <div class="col-xl-3 col-lg-6 col-12" style="display: none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success"><?php echo $con->query("select * from user")->num_rows;?></h3>
                <span>Clientes</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-user success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger"><?php echo $con->query("select * from orders where status='pending'")->num_rows;?></h3>
                <span>Ordenes Pendientes</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary"><?php echo $con->query("select * from orders where status='completed'")->num_rows;?></h3>
                <span>Ordenes Completadas</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 warning"><?php echo $con->query("select * from orders where status='cancelled'")->num_rows;?></h3>
                <span>Ordenes Canceladas</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag warning font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12" style="display:none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger"><?php echo $con->query("select * from rate_order")->num_rows;?></h3>
                <span>Customer Rating</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-like danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12" style="display:none">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary"><?php echo $con->query("select * from feedback")->num_rows;?></h3>
                <span>Total Feedback</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-bubbles primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success"><?php $sales  = $con->query("select sum(total) as full_total from orders where status='completed'")->fetch_assoc();
               
                 if($sales['full_total'] == ''){echo 0;}else {echo number_format($sales['full_total'],2); } ?></h3>
                <span>Total Vendido</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-rocket success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	

    
  </div>



          </div>
        </div>

        

      </div>
    </div>
    <style>
        .col-xl-3.col-lg-6.col-12 > .card {
    background: aliceblue;
}
        
    </style>
   <?php 
  require 'include/js.php';
  ?>
    
 
  </body>


</html>