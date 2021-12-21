<?php
include_once '../services/connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

$stmt=$pdo->prepare("SELECT * FROM `tbl_usuario` WHERE pwd_use=? and email_use=?");
$stmt->bindParam(1, $password);
$stmt->bindParam(2, $username);


$stmt->execute();

$num2=$stmt->fetchAll(PDO::FETCH_ASSOC);
$num=count($num2);

try {
    if ($num==1)
    {
        session_start();
        $_SESSION['email']=$username;
        
        foreach ($num2 as $num2) {
            if ($num2['tipo_use']=='Mantenimiento'){
                setcookie("puesto", "", time() - 3153600000, "/");
                setCookie('puesto', "Mantenimiento", time()+30000, "/");
                echo $_COOKIE["puesto"];
            }elseif ($num2['tipo_use']=='Admin'){
                setcookie("puesto", "", time() - 3153600000, "/");
                setCookie('puesto', "Admin", time()+30000, "/");
                echo $_COOKIE["puesto"];
            }
            else{
                setcookie("puesto", "", time() - 3153600000, "/");
            }
        }
        header("Location:../view/menu.php");
    }
    else {
        header("Location:../view/login.php");
    }
}catch(PDOException $e){
    header("Location:../view/login.php");
 }

