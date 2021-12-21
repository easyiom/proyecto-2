<?php
    include '../../services/connection.php';

    if(isset($_POST["enviar"])){
    $id=$_POST['hiddenid'];
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
    $stmt=$pdo->prepare("UPDATE tbl_usuario SET nombre_use=?, email_use=?,  pwd_use=?, tipo_use=?, foto_use=? WHERE id_use=?");
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $pwd);
    $stmt->bindParam(4, $tipo);
    $stmt->bindParam(5, $path);
    $stmt->bindParam(6, $id);
    
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