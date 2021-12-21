<!DOCTYPE html>
<?php include_once '../services/connection.php';
session_start();
if (isset($_SESSION['email']))
{
    if(isset($_COOKIE["puesto"]) && $_COOKIE["puesto"]!="Admin"){
        header("Location:../view/menu.php");
    }else{

?>

    

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

<body class="historial">
        <div class="atras"><a href="menu.php"><i class="far fa-arrow-alt-square-left"></i></a></div>
        <div class="logout"><a href="../services/kill-login.php"><i class="fas fa-user"></i></a></div>
<?php 
    $user=$pdo->prepare("SELECT id_use, nombre_use, email_use, tipo_use, foto_use from tbl_usuario");
    $user->execute();
    $data = $user->fetchAll(PDO::FETCH_ASSOC);
?>
    
    
<div class="region-historial flex-cv">
<button class="boton-filtro btn-abrirPop7">Crear</button>
        <table class="table-reservas">
        <thead>
            <tr><form action="./admin.php" method="POST">
                <th></th>
                <th><input type="number" id="" name="id_use" placeholder="ID user"></th>
                <th><input type="text" id="" name="nombre_use" placeholder="Nombre user"></th>
                <th><input type="text" id="" name="email_use" placeholder="Email user"></th>
                <th><input type="text" id="" name="tipo_use" placeholder="Tipo User"></th>
                
                
               <input class="boton-filtro" type="submit" value="FILTRAR">

                </form></tr>
<?php
    $queryGeneral = "SELECT id_use, nombre_use, email_use, tipo_use, foto_use from tbl_usuario WHERE id_use LIKE '%%'";



    if(isset($_POST['id_use'])){
        $id_use = $_POST['id_use'];
        $queryid_use = "AND id_use LIKE '%$id_use%'";
        $queryGeneral = $queryGeneral.$queryid_use;
    }

    if(isset($_POST['nombre_use'])){
        $nombre_use = $_POST['nombre_use'];
        $querynombreuse = "AND nombre_use LIKE '%$nombre_use%'";
        $queryGeneral = $queryGeneral.$querynombreuse;
    }


    if(isset($_POST['email_use'])){
        $email_use = $_POST['email_use'];
        $queryemailuse = "AND email_use LIKE '%$email_use%'";
        $queryGeneral = $queryGeneral.$queryemailuse;
    }
    
    if(isset($_POST['tipo_use'])){
        $tipo_use = $_POST['tipo_use'];
        $querytipouse = "AND tipo_use LIKE '%$tipo_use%'";
        $queryGeneral = $queryGeneral.$querytipouse;
    }

        $user=$pdo->prepare($queryGeneral);
        $user->execute();
        $data = $user->fetchAll(PDO::FETCH_ASSOC);
?>
                <tr>
                    <th>Foto User</th>
                    <th>ID User</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $datas) { ?>
                <tr>
                    <td><img class="imgTable"
             src="<?php if($datas['foto_use']!=null){
                 echo $datas['foto_use'];
             }else{
                 echo "../media/profile.png";
             }?>" 
             ></td>
                    <td><?php echo $datas['id_use'] ?></td>
                    <td><?php echo $datas['nombre_use'] ?></td>
                    <td><?php echo $datas['email_use'] ?></td>
                    <td><?php echo $datas['tipo_use'] ?></td>
                    <td>
                        <form action="../procedures/users/borrar-user.php" method="post">
                            <input type="hidden" name="id_use" value="<?php echo $datas['id_use'] ?>">
                            <input type="submit" value="borrar">
                        </form>
                        
                    </td>
                    
                    <td class="btn-abrirPop8" data-id="<?php echo $datas['id_use'] ?>">Modify</td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
</div>
<div class="overlay" id="overlay">
    <div class="crearUser" id="crerUser">
        <div class="popup hide" id="popup7">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            <h3>Crear usuario</h3>
            <form METHOD='POST' class="crearReserva" action="../procedures/users/crear-user.php" enctype="multipart/form-data">
                <!-- <input type="hidden" id="idMesa" class="hiddenuser" name="idMesa"> -->
                <label for="nombre">Nombre de usuario</label>
                <input type="text" required id="nombre" name="nombre">
                <label for="email">Email del usuario</label>
                <input type="text" required id="email" name="email">
                <label for="pwd">Contrasenya  usuario</label>
                <input type="password" required id="pwd" name="pwd">
                <select required name="tipo" id="tipo">
                    <option value=""></option>
                    <option value="Camarero">Camarero</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Admin">Admin</option>
                </select>
                <label for="foto">Foto de perfil (opcional)</label>
                <input type="file" name="foto" id="file" accept="image/*">
                <input type="submit" name='enviar' value="Reservar" class="btn">
            </form>
        </div>
    </div>
    <div class="modUser" id="modUser">
        <div class="popup hide" id="popup8">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrarPop"><i class="fas fa-times"></i></a>
            <h3>Modificar usuario</h3>
            <form METHOD='POST' class="crearReserva" action="../procedures/users/modificar-user.php" enctype="multipart/form-data">
                <input type="hidden" id="idMesa" class="hiddenuser" name="hiddenid">
                <label for="nombre">Nombre deusuario</label>
                <input type="text" required id="nombre" name="nombre">
                <label for="email">Email del usuario</label>
                <input type="text" required id="email" name="email">
                <label for="pwd">Contrasenya  usuario</label>
                <input type="password" required id="pwd" name="pwd">
                <select required name="tipo" id="tipo">
                    <option value=""></option>
                    <option value="Camarero">Camarero</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Admin">Admin</option>
                </select>
                <label for="foto">Foto de perfil (opcional)</label>
                <input type="file" name="foto" id="file" accept="image/*">
                <input type="submit" name='enviar' value="Reservar" class="btn">
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
