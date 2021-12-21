<?php //mirar si esta la sesion iniciada
    include_once '../procedures/class/mesa.php';
    include_once '../services/connection.php';
    include_once '../procedures/class/sala.php';
        session_start();
    if (isset($_SESSION['email']))
    {
        if(isset($_COOKIE["puesto"]) && $_COOKIE["puesto"]=="Mantenimiento"){
            header("Location:../view/mantenimiento.php");
        }else{

        
        if(isset($_COOKIE["sala"])){
            $idsala = $_COOKIE["idsala"];
            $salas = $_COOKIE["sala"];

            $sal=$pdo->prepare("SELECT * from tbl_sala where id_sal = $idsala");
            $sal->execute();
            $sal=$sal->fetchAll(PDO::FETCH_ASSOC);

            

            $fecha = $_SESSION['horas'][0];
            $fechaFi = $_SESSION['horas'][1];
            
            $reser=$pdo->prepare("SELECT r.id_res, r.id_mes_fk FROM tbl_reserva r INNER JOIN tbl_mesa m ON r.id_mes_fk=m.id_mes  where ( ('$fecha'>=r.horaIni_res AND '$fecha'<=r.horaFin_res) OR ('$fechaFi'>=r.horaIni_res AND '$fechaFi'>=r.horaFin_res) ) and m.id_sal_fk = $idsala ");
            $reser->execute();
            $reser=$reser->fetchAll(PDO::FETCH_ASSOC);
            
            

        
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas</title>
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
<body class="salass">
        <div class="atras"><a href="menu.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="titulo"><h1><?php foreach ($sal as $sal) { echo $sal['nombre_sal']; } ?></h1></div>
        <div class="titulo2"><h2><?php echo $fecha." a ".$fechaFi; ?></h2></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
        <div class="crearMesa btn-abrirPop11"><a><i class="fa fa-plus" aria-hidden="true"></i></a></div>

        
    <div class="region-mesas flex-cv <?php echo $salas;?>">
            
            <div class="grid-mesas">
                <?php
                
                
                $mesa=$pdo->prepare("SELECT * from tbl_mesa WHERE id_sal_fk= $idsala");
                $mesa->execute();
                $mesa=$mesa->fetchAll(PDO::FETCH_ASSOC);
               
                foreach ($mesa as $mesa) {
                ?>
               
               <div class="mesa btn-abrirPop mesasvg" data-id="<?php echo $mesa['id_mes']; ?>" data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>"
               

               >
               <?php if(isset($_COOKIE["puesto"]) && $_COOKIE["puesto"]=="Admin"){ ?>  
                <form class="borrar-mesa" method='post' action="../procedures/recursos/eliminar-mesa.php">
                    <input type="hidden" name='idMesa' value="<?php echo $mesa['id_mes']; ?>">
                    <input type="submit" value="X">
                </form>
                <?php } ?>

                    <?php
                    if($mesa['capacidad_mes'] ==2)
                    {
                        ?>
                        <div>
                            <img 
                                 data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>" 
                                 src="../media/mesa2.svg" alt="mesa 2 personas" 
                                 class="mesa-2 <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){
                                     echo 'ocupada';
                                 }?> ">
                        </div>
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==4)
                    {
                        ?>
                        <div>
                            <img
                             data-id="<?php echo $mesa['id_mes']; ?>" 
                             data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>"  
                             class="mesa-4 <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'ocupada';}?> " 
                             src="../media/mesa4.svg" alt="mesa 4 personas">
                        </div>
                        <?php    
                    }
                    elseif($mesa['capacidad_mes'] ==6)
                    {
                        ?>
                        <div>
                            <img data-id="<?php echo $mesa['id_mes']; ?>" 
                            data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>" 
                            class="mesa-6 <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'ocupada';}?> " 
                            src="../media/mesa6.svg" alt="mesa 6 personas">
                        </div>
                        <?php
                    }
                    elseif($mesa['capacidad_mes'] ==10)
                    {
                        ?>
                        <div>
                            <img data-id="<?php echo $mesa['id_mes']; ?>" 
                            data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>" 
                            class="mesa-10 <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'ocupada';}?> "
                            src="../media/mesa10.svg" alt="mesa 10 personas">
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div>
                            <img data-id="<?php echo $mesa['id_mes']; ?>" 
                            data-status="<?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?>" 
                            class="mesa-4 <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'ocupada';}?> "
                            src="../media/mesa4.svg" alt="mesa 4 personas">
                        </div>
                        <?php
                    }
                    ?>
                    <div><p>Mesa nº <?php echo $mesa['id_mes']; ?></p></div>
                    <div><p>Mesa de <?php echo $mesa['capacidad_mes']; ?></p></div>
                    <div><p>Estado:  <?php if(in_array($mesa['id_mes'],$_SESSION['mesas'])){echo 'Ocupado/Reservado';}else{echo 'Libre';}?></p></div>


                       
                </div>

                <?php
                }
                ?>

            </div>
      
    </div>

    <?php 
 
    ?>
    <div class="overlay" id="overlay">
        <div class="abrirReserva" id="abrirReserva">
            <div class="popup hide" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Reservar mesa</h3>
                <form METHOD='POST' class="crearReserva" action="../procedures/reservar-mesa.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <input type="hidden" id="fechaIni" class="fechaIni" name="fechaIni" value='<?php echo $fecha?>'>
                    <input type="hidden" id="fechaFi" class="fechaFi" name="fechaFi" value='<?php echo $fechaFi?>'>
                    <label for="nombre">Nombre de la reserva</label>
                    <input required type="text" id="nombre" name="nombre">

                    <input type="submit" value="Reservar" class="btn">
                </form>
            </div>
        </div>

        <div class="cerrarReserva" id="cerrarReserva">
            <div class="popup hide" id="popup2">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Modificar reserva</h3>
                <form METHOD='POST'  class="editarReserva" action="../procedures/acabar-reserva.php">
                    <input type="hidden" id="idMesa" class="idMesa" name="idMesa">
                    <input type="hidden" id="fechaIni" class="fechaIni" name="fechaIni" value='<?php echo $fecha?>'>
                    <input type="hidden" id="fechaFi" class="fechaFi" name="fechaFi" value='<?php echo $fechaFi?>'>
                    <label for="seguro">Seguro que quieres borra la reserva?</label>
                    <input type="checkbox" required name="seguro" id="seguro">
                    <input type="submit" value="borrar" class="btn">
                </form>
            </div>
        </div>

        <div class="nuevaMesa" id="nuevaMesa">
            <div class="popup hide" id="popup11">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
                <h3>Nueva Mesa</h3>
                <form METHOD='POST' class="crearReserva" action="../procedures/recursos/crear-mesa.php" enctype="multipart/form-data">
                <input type="hidden" id="idSala" class="idMesa" value="<?php echo $idsala; ?>" name="idSala">
                <label for="medida">Medida de la mesa</label>
                    <select required name="medida" id="medida">
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="10">10</option>
                    </select>
                    <input type="submit" name='enviar' value="enviar" class="btn">
                </form>
            </div>
        </div>
    </div>
    <?php
    
    }else{
        header("Location:../view/menu.php");
    }
    }
    }else
    {
        header("Location:../view/login.php");
    }
    ?>
</body>
</html>