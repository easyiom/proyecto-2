<?php
session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../procedures/class/reserva.php';
include '../procedures/class/mesa.php';
$mesa = $_POST['idMesa'];
$fecha = $_POST['fechaIni'];
$fechaFi = $_POST['fechaFi'];




$stmt=$pdo->prepare("UPDATE `tbl_reserva` SET `estado_res` =0 WHERE tbl_reserva.id_mes_fk = ? and ( ('$fecha'>=horaIni_res AND '$fecha'<=horaFin_res) OR ('$fechaFi'>=horaIni_res AND '$fechaFi'>=horaFin_res) )");
$stmt->bindParam(1, $mesa);
$stmt->execute();



// $stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Libre' WHERE `tbl_mesa`.`id_mes` = ?");
// $stmt2->bindParam(1, $mesa);
// $stmt2->execute();




//redirigir al sala.php desde donde se envio
header("Location:../View/sala.php");
}else
{
    header("Location:../view/login.php");
}
