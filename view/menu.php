<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['email']))
    {
        if(isset($_COOKIE["puesto"]) && $_COOKIE["puesto"]=="Mantenimiento"){
            header("Location:../view/mantenimiento.php");
        }else{
    
        include_once '../procedures/class/sala.php';
        include_once '../procedures/class/mesa.php';
        include_once '../services/connection.php';
        $salas=$pdo->prepare("SELECT * from tbl_sala");
        $salas->execute();
        $salas=$salas->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salas</title>
    <!-- librerias-->
    <script type="text/javascript" src="../js/jquery.js"></script><!-- jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.0/src/js.cookie.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><!-- sweetalert-->
    <script type="text/javascript" src="../js/iconos_g.js"></script><!-- iconos FontAwesome-->
    <script type="text/javascript" src="../js/js.js"></script>
    <link rel="icon" type="image/png" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="menu">
   
        
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
   
    <div class="region-salas">
        <div class="grid-salas flex-cv">
        <?php
        foreach ($salas as $salas) {

            $capacidad_libre=$pdo->prepare("SELECT SUM(capacidad_mes) from tbl_mesa where status_mes = 'Libre' && id_sal_fk=?");
            $capacidad_libre->bindParam(1, $salas['id_sal']);
            $capacidad_libre->execute();
            $capacidad_libre = $capacidad_libre->fetch(PDO::FETCH_NUM);


            $mesas_libres=$pdo->prepare("SELECT * from tbl_mesa WHERE status_mes = 'Libre' && id_sal_fk = ?");
            $mesas_libres->bindParam(1, $salas['id_sal']);
            $mesas_libres->execute();
            $mesas_libres=$mesas_libres->fetchAll(PDO::FETCH_ASSOC);


            $mesas_ocupadas=$pdo->prepare("SELECT * from tbl_mesa WHERE status_mes = 'Ocupado/Reservado' && id_sal_fk = ?");
            $mesas_ocupadas->bindParam(1, $salas['id_sal']);
            $mesas_ocupadas->execute();
            $mesas_ocupadas=$mesas_ocupadas->fetchAll(PDO::FETCH_ASSOC);

                ?>
            <div class="sala btn-abrirPop6" data-id="<?php echo $salas['id_sal'] ?>">
            <!-- <form  method="post" action="../procedures/cookieMesa.php">
                <input class="enviar" type="hidden" name="hiddensala" value="<?php echo $salas['id_sal'] ?>"><input name="enviar" type="submit">
            </form> -->
                <!-- <a href="sala2.php"></a> -->
                <img src="../media/icons/<?php echo $salas['imagen_sal']?>" alt="">
                <h2><?php echo $salas['nombre_sal'] ?></h2>
                <table>
                    <tbody>
                        <tr>
                            <th>Capacidad total: </th>
                            <td><?php echo $capacidad_libre[0] ?> personas</td>
                        </tr>
                        
                        <tr>
                            <th>Mesas: </th>
                            <td><?php echo count($mesas_libres) ?> mesas</td>
                        </tr>
                        
                    </tbody>
                    
                </table>
                
            </div>

            <?php 
                    }
            ?>
            <div class="container-absolute">
                <a class="btn-reservas" href="historial.php">Reservas</a>
                <?php if(isset($_COOKIE["puesto"]) && $_COOKIE["puesto"]=="Admin"){ ?>  
                    <a class="btn-reservas" href="admin.php">Admin</a>
                    <a class="btn-reservas btn-abrirPop10">Modify</a>
                <?php } ?>
            </div>
    </div>

    <div class="overlay" id="overlay">
        <div class="hreserva" id="hreserva">
            <div class="popup hide" id="popup6">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Escoje hora</h3>
                <form METHOD='POST' class="crearReserva" action="../procedures/cookieSala.php">
                    <input type="hidden" id="hiddensala" class="hiddensala" name="hiddensala">
                    <label for="nombre">Hora Inicio</label>
                    <input type="datetime-local" id="fechaIni" required name="fechaIni">
                    <input type="submit" name='enviar' value="enviar" class="btn">
                </form>
            </div>
        </div>

        <div class="modifySala" id="modifySala">
            <div class="popup hide" id="popup10">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Modificar Sala</h3>
                <form METHOD='POST' class="crearReserva" action="../procedures/recursos/modificar-sala.php" enctype="multipart/form-data">
                <label for="id">Selecciona que sala quiere modificar</label>
                    <select required name="id" id="id">
                        
                        <option value="1">Sala 1</option>
                        <option value="2">Sala 2</option>
                        <option value="3">Sala 3</option>
                        <option value="4">Sala 4</option>
                        <option value="5">Sala 5</option>
                    </select>
                    <label for="nombre">Nuevo nombre Sala</label>
                    <input type="text" id="nombre" required name="nombre">
                    <label for="foto">Foto sala</label>
                    <input type="file" name="foto" id="file" accept="image/*">
                    <input type="submit" name='enviar' value="enviar" class="btn">
                </form>
            </div>
        </div>
    </div>
    <?php
    }//cookie mantenimiento
    }else
    {
        header("Location:../view/login.php");
    }
    ?>
</body>
</html>

