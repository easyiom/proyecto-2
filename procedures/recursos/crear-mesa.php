<?php
    include '../../services/connection.php';

    if(isset($_POST["enviar"])){

    $idSala=$_POST['idSala'];
    $medida=$_POST['medida'];
    $estado='Libre';


    $pdo -> beginTransaction();
    $stmt=$pdo->prepare("INSERT INTO tbl_mesa(id_mes, status_mes, capacidad_mes, id_sal_fk) VALUES(null, ?, ?, ?)");
    $stmt->bindParam(1, $estado);
    $stmt->bindParam(2, $medida);
    $stmt->bindParam(3, $idSala);
    
    
        try{
            if($stmt->execute()){
            $pdo->commit();
            header("Location:../../view/menu.php");
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            $pdo->rollBack();
            header("Location:../../view/menu.php");
        }
    }else{
        header("Location:../../view/menu.php");
    }