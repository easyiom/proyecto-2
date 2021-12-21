<?php
session_start();
if (isset($_SESSION['email']))
{
include_once '../../services/connection.php';



$idMesa = $_POST['idMesa'];


$stmt=$pdo->prepare("DELETE FROM `tbl_reserva` WHERE id_mes_fk=$idMesa");
$stmt->execute();

$stmt=$pdo->prepare("DELETE FROM `tbl_mesa` WHERE id_mes=$idMesa");
$stmt->execute();



//redirigir al sala.php desde donde se envio
header("Location:../../view/menu.php");
}else
{
    header("Location:../../view/login.php");
}
