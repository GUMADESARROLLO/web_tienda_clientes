
<?php 

require 'include/dbconfig.php';

$pid = $_POST['pid'];
$c = $con->query("select * from orders where id=".$pid."")->fetch_assoc();
$uinfo = $con->query("select * from address where id=".$c['address_id']."")->fetch_assoc();
$user = $con->query("select * from user where id=".$c['uid']."")->fetch_assoc();


?>
<input type='button' id='btn' class="btn btn-primary text-right" value='Print' onclick='printDiv();' style="float:right;">
<div id="divprint">
<h5><b>Nº  <?php echo  substr("00000000", strlen($pid)).$pid; ?></b></h5>
<h5><b>Nombre :  <?php echo $user['name'];?></b></h5>
<h5><b>Telefono :  <?php echo $user['mobile'];?></b></h5>
<h5><b>Dirección : <?php echo $c['address_txt'];?></b></h5>



<h5><b>Fecha:  <?php echo $c['ddate'];?></b></h5>
    <h5><b>Comentario:  <?php echo $c['Comentario'];?></b></h5>

<?php 
if($c['p_method'] == 'Cash on delivery' or $c['p_method'] == 'Cash On Delivery' or $c['p_method'] == 'Pickup myself' or $c['p_method'] == 'Pickup Myself')
{
}
else
{
	?>

	<?php 
}
?>
<div class="table-responsive">
<table class="table">
<tr>
<th>SKU</th>
<th>Nombre</th>
<th>UND</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Bonificado</th>
<th>Total</th>
</tr>
<?php 
$prid = explode('$;',$c['pid']);
$product_name = explode('$;',$c['pname']);
$qty = explode('$;',$c['qty']);
$ptype = explode('$;',$c['ptype']);
$pprice = explode('$;',$c['pprice']);
$Bonifi = explode('$;',$c['boni']);
$pcount = count($qty);

$op = 0;
$subtotal = 0;
	 $ksub = array();
	 
for($i=0;$i<$pcount;$i++)
{

	?>
<tr>
<td><?php echo $prid[$i];?></td>
<td><?php echo $product_name[$i];?></td>

<td><?php echo $ptype[$i];?></td>
<td><?php echo "C$ ".number_format($pprice[$i],2,".",",");?></td>
<td><?php echo $qty[$i];?></td>
<td><?php echo $Bonifi[$i];?></td>
<td><?php echo "C$ ".number_format(($pprice[$i] * $qty[$i]),2,".",","); ?></td>

</tr>
<?php


        $ksub [] = $subtotal  + ($qty[$i] * $pprice[$i]) ;
        
} ?>
</table>
</div>
<?php
$subtotal = number_format((float)array_sum($ksub), 2, '.', ',');
$tax = number_format($c['tax'], 2, '.', ',');

 
?>
<ul class="list-group">
  <li class="list-group-item" style="display: none;">
    <span class="badge bg-primary float-right budge-own" ><?php echo $c['p_method'];?></span> Metodo de Pago
  </li>
  <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo "C$ ".$subtotal; ?></span> Sub Total
  </li>
  
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $tax;?></span> IVA
  </li>
    
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo number_format($c['total'],2,'.',',');?></span> Total
  </li>
  <li class="list-group-item">
    <span class="badge bg-warning float-right budge-own" ><?php echo $c['status'];?></span> Status
  </li>
 
</ul>
</div>