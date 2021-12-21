<?php
    include '../../services/connection.php';

    if(isset($_POST["enviar"])){
    $id=$_POST['id'];
    $nom=$_POST['nombre'];




    if(isset( $_FILES["foto"] ) && !empty( $_FILES["foto"]["name"] )){
        $nameimg=$_FILES['foto']['tmp_name'];
        $dateimg=date('Y-m-d-H-i-s');
        $path="{$dateimg}_{$_FILES['foto']['name']}";
        $newpath="../../media/icons/{$dateimg}_{$_FILES['foto']['name']}";
        move_uploaded_file($nameimg, $newpath);
    }else{
        $path = null;
    }




    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("UPDATE tbl_sala SET nombre_sal=?, imagen_sal=? WHERE id_sal=?");
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $path);
    $stmt->bindParam(3, $id);
    
        try{
            if($stmt->execute()){
            $pdo->commit();
            // header("Location:../../view/admin.php");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            unlink($nameimg);
            $pdo->rollBack();
            // header("Location:../../view/admin.php");
        }
    }else{
        // header("Location:../../view/admin.php");
    }