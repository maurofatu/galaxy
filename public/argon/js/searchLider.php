<?php
include('../config/conexion.php');

$cedula = $_POST['cedula'];

$sql = "SELECT * FROM lideres WHERE cedula = ? limit 1";
$sent = $con->prepare($sql);
$sent->execute(array($cedula));
$result = $sent->fetch();

if(!$result){
    echo "false";
}else{
    // var_dump($result);
    echo $result['nombres'];
}
