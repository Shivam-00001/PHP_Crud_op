<?php
include "include/config.php";
$id= $_GET['id'];

$sql_query = "DELETE FROM `crud_table` WHERE `id`= $id";
$result = mysqli_query($connection,$sql_query); 
if($result){
    echo "<script> location.replace('admin_reg&login/admin_dashbord.php')</script>";
}else{
    echo  $connection->error;
}
?>