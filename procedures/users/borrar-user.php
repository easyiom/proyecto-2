<?php
session_start();
if (isset($_SESSION['email']))
{
include '../../services/connection.php';
include '../../procedures/class/reserva.php';
include '../../procedures/class/mesa.php';
$id_use = $_POST['id_use'];


$stmt=$pdo->prepare("DELETE FROM `tbl_reserva` WHERE id_use_fk=$id_use");
$stmt->execute();

$stmt=$pdo->prepare("DELETE FROM `tbl_usuario` WHERE id_use=$id_use");
$stmt->execute();



// $stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Libre' WHERE `tbl_mesa`.`id_mes` = ?");
// $stmt2->bindParam(1, $mesa);
// $stmt2->execute();




//redirigir al sala.php desde donde se envio
header("Location:../../view/admin.php");
}else
{
    header("Location:../../view/login.php");
}
