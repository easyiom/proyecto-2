<?php


session_start();
if (isset($_SESSION['email']))
{
include '../services/connection.php';
include '../services/reserva.php';
include '../services/mesa.php';

if (isset($_POST['cerrarinci'])){
    $id_inci = $_POST['data-id-inci'];
    $id_mes = $_POST['data-mes'];


    $stmt2=$pdo->prepare("UPDATE `tbl_mantenimiento` SET `fecha_fin_inci` = NOW() WHERE `tbl_mantenimiento`.`id_inci` = ?");
    $stmt2->bindParam(1, $id_inci);
    $stmt2->execute();


    $stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Libre' WHERE `tbl_mesa`.`id_mes` = ?");
    $stmt2->bindParam(1, $id_mes);
    $stmt2->execute();
    header("Location:../View/mantenimiento.php");

}else{

$nombre = $_POST['datos_inci'];
$responsable = $_SESSION['email'];
$mesa = $_POST['id_mesa'];

$idusu=$pdo->prepare("SELECT * from tbl_usuario where tbl_usuario.email_use=?");
$idusu->bindParam(1, $responsable);
$idusu->execute();

$idusu=$idusu->fetchAll(PDO::FETCH_ASSOC);
foreach ($idusu as $idusu) {
    $responsable = $idusu['id_use'];
}

echo $responsable;



$stmt=$pdo->prepare("INSERT INTO `tbl_mantenimiento` (`id_inci`, `datos_inci`, `fecha_ini_inci`, `fecha_fin_inci`,  `id_mes_fk`, `id_use_fk`) VALUES (NULL, ?,NOW(), NULL, ?,?)");
$stmt->bindParam(1, $nombre);
$stmt->bindParam(3, $responsable);
$stmt->bindParam(2, $mesa);
$stmt->execute();


$stmt2=$pdo->prepare("UPDATE `tbl_mesa` SET `status_mes` = 'Mantenimiento' WHERE `tbl_mesa`.`id_mes` = ?");
$stmt2->bindParam(1, $mesa);
$stmt2->execute();



//redirigir al sala.php desde donde se envio
header("Location:../View/mantenimiento.php");
}
}else
{
    header("Location:../view/login.php");
}
