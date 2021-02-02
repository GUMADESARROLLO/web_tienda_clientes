<?php 

require 'include/dbconfig.php';

require 'api/db.php';
$cid = $_POST['catid'];
  $sqlsrv = new Sqlsrv();
  $myarray = array();
  $qSubCategoria = $sqlsrv->fetchArray("SELECT T0.ID_CLAS_1,T0.ID_CLAS_3,T0.Clasificacion_3,COUNT(T0.ID_CLAS_3) AS CNT FROM UMK_STORE_MASTER T0 WHERE T0.ID_CLAS_1 = '".$cid."'  AND STOCK > 0 GROUP BY T0.ID_CLAS_1,T0.ID_CLAS_3,T0.Clasificacion_3 HAVING COUNT(T0.ID_CLAS_3) > 0 ", SQLSRV_FETCH_ASSOC);



?>
<option value="">Seleccione SubCategoria</option>
<?php 

foreach ($qSubCategoria as $SubCat) {
	?>
	<option value="<?php echo $SubCat['ID_CLAS_3'];?>"><?php echo $SubCat['Clasificacion_3'];?></option>
	<?php 
}