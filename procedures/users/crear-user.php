<?php
    include '../../services/connection.php';

    if(isset($_POST["enviar"])){

    $nom=$_POST['nombre'];
    $email=$_POST['email'];
    $pwd=md5($_POST['pwd']);
    $tipo=$_POST['tipo'];



    if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
        $nameimg=$_FILES['foto']['tmp_name'];
        $dateimg=date('Y-m-d-H-i-s');
        $path="../public/users/{$dateimg}_{$_FILES['foto']['name']}";
        $newpath="../../public/users/{$dateimg}_{$_FILES['foto']['name']}";
        move_uploaded_file($nameimg, $newpath);
    }else{
        $path = null;
    }




    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_usuario(id_use, nombre_use, email_use, pwd_use,  tipo_use,  foto_use) VALUES(null, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $pwd);
    $stmt->bindParam(4, $tipo);
    $stmt->bindParam(5, $path);
    
        try{
            if($stmt->execute()){
            $pdo->commit();
            header("Location:../../view/admin.php");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            unlink($nameimg);
            $pdo->rollBack();
            header("Location:../../view/admin.php");
        }
    }else{
        header("Location:../../view/admin.php");
    }