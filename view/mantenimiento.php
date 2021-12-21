<!DOCTYPE html>
<?php include_once '../services/connection.php';
session_start();
if (isset($_SESSION['email']))
{
    if(!isset($_COOKIE["puesto"]) && !$_COOKIE["puesto"]=="Mantenimiento"){
        header("Location:../view/menu.php");
    }else{

?>

    

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script><!-- cookie-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="mantenimiento">
        
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
        
<?php 
    $inci=$pdo->prepare("SELECT *
    FROM tbl_mantenimiento m;");
    $inci->execute();
    $data = $inci->fetchAll(PDO::FETCH_ASSOC);
?>
    
    
<div class="region-mantenimiento flex-cv">

        <table class="table-mantenimiento">
        <thead>
            <tr><form action="./mantenimiento.php" method="POST">
                <th><input type="number" id="" name="id_inci" placeholder="ID incidencia"></th>
                <th><input type="text" id="" name="datos_inci" placeholder="Datos incidencia"></th>
                <th><input type="date" id="" name="hora_ini_inci" placeholder="fecha Inicio"></th>
                <th><input type="date" id="" value="" name="hora_fin_inci" placeholder="Fecha final"></th>
                
                <th><select name='id_mesa' value=''>
                    <option value=""></option>
                
                <?php 
                    $mesa1=$pdo->prepare("SELECT id_mes FROM tbl_mesa");
                    $mesa1->execute();
                    $data = $mesa1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $reg) {
                ?>
                    <option value="<?php echo $reg['id_mes'];?>"><?php echo $reg['id_mes'];?></option>
                <?php } ?>
                </select><input class="boton-filtro" type="submit" value="FILTRAR"></th> 

                </form></tr>
<?php
    $queryGeneral = "SELECT *
    FROM tbl_mantenimiento m
    WHERE id_inci LIKE '%%'";

    if(isset($_POST['id_inci'])){
        $id_inci = $_POST['id_inci'];
        $queryid_res = "AND m.id_inci LIKE '%$id_inci%'";
        $queryGeneral = $queryGeneral.$queryid_res;
    }

    if(isset($_POST['hora_ini_inci'])){
        $hora_ini_inci = $_POST['hora_ini_inci'];
        $queryhoraIni = "AND m.fecha_ini_inci LIKE '%$hora_ini_inci%'";
        $queryGeneral = $queryGeneral.$queryhoraIni;
    }

    if(!empty($_POST['hora_fin_inci'])){//hacerlo con addtime
        $hora_fin_inci = $_POST['hora_fin_inci'];
        $queryhoraFin = "AND m.fecha_fin_inci LIKE '%$hora_fin_inci%'";
        $queryGeneral = $queryGeneral.$queryhoraFin;
    }

    if(isset($_POST['datos_inci'])){
        $datos_inci = $_POST['datos_inci'];
        $querydatos_res = "AND m.datos_inci LIKE '%$datos_inci%'";
        $queryGeneral = $queryGeneral.$querydatos_res;
    }

  

    if(isset($_POST['id_mes'])){
        $id_mes = $_POST['id_mes'];
        $queryidmes = "AND m.id_mes LIKE '%$id_mes%'";
        $queryGeneral = $queryGeneral.$queryidmes;
    }

   

        $reserva=$pdo->prepare($queryGeneral);
        $reserva->execute();
        $data = $reserva->fetchAll(PDO::FETCH_ASSOC);
?>
                <tr>
                    <th>ID Incidencia</th>
                    <th>Datos Incidencia</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Mesa</th>
                    <th><div class="crear-inci btn-abrirPop3"><a ><i class="fas fa-plus"></i></a></div></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $datas) { ?>
                <tr>
                    <td><?php echo $datas['id_inci'] ?></td>
                    <td><?php echo $datas['datos_inci'] ?></td>
                    <td><?php echo $datas['fecha_ini_inci'] ?></td>
                    <td><?php echo $datas['fecha_fin_inci'] ?></td>
                    <td><?php echo $datas['id_mes_fk'] ?></td>
                    <?php if (empty($datas['hora_fin_inci'])){
                            echo "<td><div data-mes=".$datas['id_mes_fk']." data-id-inci=".$datas['id_inci']." class='crear-inci btn-abrirPop4'><a ><i class='fas fa-minus'></i></a></div><td>";
                    }
                        ?>
                </tr>

                <?php } ?>
            </tbody>
        </table>
  
    
</div>

<div class="overlay" id="overlay">
        <div class="abrirInci" id="abrirInci">
            <div class="popup" id="popup3">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Crear incidencia</h3>
                <form METHOD='POST' class="crearnci" action="../procedures/mantenimiento-mesa.php">
                    <label for="datos_inci">Datos incidencia</label>
                    <select name='id_mesa' value=''>
                
            <?php 
                $mesa1=$pdo->prepare("SELECT id_mes FROM tbl_mesa");
                $mesa1->execute();
                $data = $mesa1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $reg) {
            ?>
                <option  value="<?php echo $reg['id_mes'];?>"><?php echo $reg['id_mes'];?></option>
            <?php } ?>
            </select>
                    <textarea name="datos_inci" id="datos_inci" cols="30" rows="10"></textarea>
                    <input type="submit" value="Reservar" class="btn">
                </form>
            </div>
        </div>
        <div class="cerrarInci" id="cerrarInci">
            <div class="popup" id="popup4">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Cerrar incidencia</h3>
                <form METHOD='POST' class="crearnci" action="../procedures/mantenimiento-mesa.php">
                    <input type="hidden" class="data-id-inci" name="data-id-inci">
                    <input type="hidden" class="data-mes" name="data-mes">
                    <input type="submit" name="cerrarinci" value="Cerrar incidencia" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}//cookie mantenimiento
}else
{
    header("Location:../view/login.php");
} 
?>