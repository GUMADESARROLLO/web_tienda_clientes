<?php
//session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  //Username, Password and Database

  //PRODUCCION
  //$DataBase = "grocery_14";
  
  //DEMO
  $DataBase = "tienda_umk";

  $con = new mysqli("localhost", "root", "a7m1425.", $DataBase);
  $con->set_charset("utf8mb4");

  $connect = new mysqli("192.168.1.15", "Dios", "a7m1425.", "ecommerce_android_app");
  $connect->set_charset("utf8mb4");


} catch(Exception $e) {
  error_log($e->getMessage());
  //Should be a message a typical user could understand
}
$fset = $con->query("select * from setting")->fetch_assoc();
$fetch_main = $con->query("select * from main_setting")->fetch_assoc();

date_default_timezone_set($fset['timezone']);
$dirname = dirname( dirname(__FILE__) ).'/api';
?>

