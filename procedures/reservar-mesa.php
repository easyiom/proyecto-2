<?php


session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include 'class/reserva.php';
include 'class/mesa.php';

$nombre = $_POST['nombre'];
$fecha = $_POST['fechaIni'];
$fechaFi = $_POST['fechaFi'];
$responsable = $_SESSION['email'];
$mesa = $_POST['idMesa'];

$idusu=$pdo->prepare("SELECT * from tbl_usuario where tbl_usuario.email_use=?");
$idusu->bindParam(1, $responsable);
$idusu->execute();

$idusu=$idusu->fetchAll(PDO::FETCH_ASSOC);
foreach ($idusu as $idusu) {
    $responsable = $idusu['id_use'];
}

echo $responsable;



$stmt=$pdo->prepare("INSERT INTO `tbl_reserva` (`id_res`, `horaIni_res`, `horaFin_res`, `datos_res`, `id_use_fk`, `id_mes_fk`, `estado_res`) VALUES (NULL, ?, ?, ?, ?, ?, 1)");
$stmt->bindParam(1, $fecha);
$stmt->bindParam(2, $fechaFi);
$stmt->bindParam(3, $nombre);
$stmt->bindParam(4, $responsable);
$stmt->bindParam(5, $mesa);

$stmt->execute();


// $stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Ocupado/Reservado' WHERE `tbl_mesa`.`id_mes` = ?");
// $stmt2->bindParam(1, $mesa);
// $stmt2->execute();



//redirigir al sala.php desde donde se envio
header("Location:../View/menu.php");
}else
{
    header("Location:../view/login.php");
}
