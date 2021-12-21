<?php
session_start();
include_once '../services/connection.php';
if (isset($_SESSION['email']))
{
    if(isset($_POST["enviar"])){
        $idsala = $_POST['hiddensala'];
        //print_r($idsala);
        $fecha = date_create($_POST['fechaIni']);
        $fecha1 = date_create($_POST['fechaIni']);
        // print_r($fecha);        
        $fechaFi = date_add($fecha1, new DateInterval('PT5400S'));//le sumamos 1.5h (5400s) a la fecha inicio, creando asi la fecha final
        $fecha = $fecha->format( 'Y/m/d H:i:s' );//pasamos a string con este formato
        
        $fechaFi = $fechaFi->format( 'Y/m/d H:i:s' );//pasamos a string con este formato
        //El select basicamente mira si los rangos de fecha confluyen entre si. Como si o si las reservas duran 1.5h podemos mirarlo con estas condiciones.
        //Como el usuario ya ha elegido la sala, solo busca en las mesas de la sala selecionada
        
        $reser=$pdo->prepare("SELECT r.id_mes_fk FROM tbl_reserva r INNER JOIN tbl_mesa m ON r.id_mes_fk=m.id_mes  where ( ('$fecha'>=r.horaIni_res AND '$fecha'<=r.horaFin_res) OR ('$fechaFi'>=r.horaIni_res AND '$fechaFi'<=r.horaFin_res) ) and m.id_sal_fk = $idsala and r.estado_res <> 0");
        
        print_r($reser);    
        $reser->execute();
        
            $reser=$reser->fetchAll(PDO::FETCH_ASSOC);
            echo("<br>");
        echo("<br>");
        print_r($reser);
        echo("<br>");
        echo("<br>");
            $mesitas = array();
            foreach($reser as $reser){
                array_push($mesitas, $reser['id_mes_fk']) ;
            }
        print_r($mesitas);
        $horitas=array($fecha, $fechaFi);

        $sala="sala".$idsala;
        setcookie("idsala", "", time() - 3153600000, "/");
        setCookie('idsala', "$idsala", time()+30000, "/");
        setcookie("sala", "", time() - 3153600000, "/");
        setCookie('sala', "$sala", time()+30000, "/");
        $_SESSION['horas']=$horitas;
        $_SESSION['mesas']=$mesitas;
        header("Location:../view/sala.php");
    }else{
        header("Location:../view/menu.php");
    }
}else
{
    header("Location:../view/login.php");
}
?>