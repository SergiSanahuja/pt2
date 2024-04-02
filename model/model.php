<?php
include_once 'connexio.php';

function insertarUsuari($data){
    try {
        $conection = connexio();
        $sql = "INSERT INTO `usuaris`(`nom`, `cognom`, `edat`, `curs`, `grup`, `admin`, `prof`) VALUES (?, ?, ?, ?, 0, 0, 0)";
        
        foreach($data as $row){
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $row[0]);
            $stmt->bindParam(2, $row[1]);
            $stmt->bindParam(3, $row[2]);
            $stmt->bindParam(4, $row[3]);
            $stmt->execute();
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function modificarUser($data){
    try {
        $conection = connexio();
        $sql = "UPDATE `usuaris` SET `nom`=?,`cognom`=?,`edat`=?,`curs`=? WHERE `id`=?";
        
        foreach($data as $row){
            $stmt = $conection->prepare($sql);
            $stmt->bindValue(1, $row[0]);
            $stmt->bindParam(2, $row[1]);
            $stmt->bindParam(3, $row[2]);
            $stmt->bindParam(4, $row[3]);
            $stmt->bindParam(5, $row[4]);
            $stmt->execute();
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function eliminarUsuari(){
    try {
        $conection = connexio();
        $sql = "DELETE FROM `usuaris` where prof=0 AND admin=0";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function borrarUsuari($data){
    try {
        $conection = connexio();
        $sql = "DELETE FROM `usuaris` WHERE id = ?";
        
        foreach($data as $row){
            $stmt = $conection->prepare($sql);
            $stmt->bindParam(1, $row[0]);
            $stmt->execute();
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarUsuari(){
    try {
        $conection = connexio();
        $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` WHERE admin =0 AND prof = 0";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarNom(){
    try {
        $conection = connexio();
        $sql = "SELECT nom,cognom,id,grup FROM `usuaris` where prof=0 AND admin= 0";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarPerLletra(){
    try {
        $conection = connexio();
        $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` Where prof=0 AND admin = 0 ORDER BY nom";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarPerCurs(){
    try {
        $conection = connexio();
        $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` Where prof=0 AND admin = 0 ORDER BY curs";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarPerEdat(){
    try {
        $conection = connexio();
        $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` WHERE prof=0 AND admin = 0 ORDER BY edat";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function insertGrup($data){
    try {
        $conection = connexio();
        $sql = "INSERT INTO `grups`(`titol`, `image`, `nom`, `punts`) VALUES (?,'default.jpg' ,?, 0)";

        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $data[0]);
        $stmt->bindParam(2, $data[0]);
        $stmt->execute();

        $grups = "INSERT INTO `usuaris` (`nom`,`email`,`password`, prof, admin) VALUES (?, ?, ?, 0, 0)";

        $stmt = $conection->prepare($grups);
        $stmt->bindParam(1, $data[0]);
        $stmt->bindParam(2, $data[1]);
        $passwordHash = password_hash($data[2], PASSWORD_DEFAULT);
        $stmt->bindParam(3, $passwordHash);
        $stmt->execute();

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function eliminarGrup(){
    try {
        $conection = connexio();
        $sql = "DELETE FROM `grups`";
        $stmt = $conection->prepare($sql);
        $stmt->execute();


        $sql = "DELETE FROM `usuaris` WHERE prof=0 AND admin=0 and edat=0";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function insertUsuariGrup($data){
    try {
        $conection = connexio();
        $sql = "UPDATE `usuaris` SET `grup`=? WHERE `id`=?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $data[0]);
        $stmt->bindParam(2, $data[1]);
        $stmt->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function createUser($email, $password, $type){
    try {
        if($type == 'admin'){
            $conection = connexio();
            $sql = "INSERT INTO `usuaris`(`email`, `password`, `admin`) VALUES (?, ?, 1)";
        }else if($type == 'prof'){
            $conection = connexio();
            $sql = "INSERT INTO `usuaris`(`email`, `password`, `prof`) VALUES (?, ?, 1)";
        }        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getUsersGrups($data){
    try {
        $conection = connexio();
        $sql = "SELECT nom,cognom FROM `usuaris` WHERE grup = ? and prof=0";
    
    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $data[1]);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getNumGrups(){
    try{
    $conection = connexio();
    $sql = "SELECT COUNT(nom) as CountGrups FROM `grups`";
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getNomGrups(){
    try{
    $conection = connexio();
    $sql = "SELECT * FROM `grups`";
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getGrup($email){
    try{
    $conection = connexio();
    $sql = "SELECT * FROM `usuaris` WHERE `email` = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    $grups = "SELECT * FROM `grups` WHERE `nom` = ?";
    $stmt = $conection->prepare($grups);
    $stmt->bindParam(1, $result->nom);
    $stmt->execute();
    $resultGrup = $stmt->fetch(PDO::FETCH_OBJ);

    return $resultGrup;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getPuntuacio($grup){
    try{
    $conection = connexio();
    $sql = "SELECT * FROM `grups` WHERE `nom` = ?";
    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $grup);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    return $result;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}

function canviarGrup($data){
    try{
    $conection = connexio();
    $sql = "UPDATE `usuaris` SET `grup`=? WHERE `id`=?";


    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $data->idGrup);
    $stmt->bindParam(2, $data ->idUser);
    $stmt->execute();

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getGrupByEmail($email){
    try {
        $conection = connexio();
        $sql = "SELECT `grup` FROM `usuaris` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return $result['grup'];
        } else {
            return false;
        }

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getUsuarisGrup($Grup){
    try {
        $conection = connexio();
        $sql = "SELECT * FROM `usuaris` WHERE `grup` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $Grup);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getActivitats(){
    try {
        $conection = connexio();
        $sql = "SELECT * FROM `tallers`";
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function updatePerfil($nomGrup, $fotoPerfil, $nom){
    try {
        $conection = connexio();
        
        // Obtener el nombre de la imagen actual si existe
        $sql_select = "SELECT `image` FROM `grups` WHERE `nom` = ?";
        $stmt_select = $conection->prepare($sql_select);
        $stmt_select->bindParam(1, $nom);
        $stmt_select->execute();
        $result = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        // Si se ha subido una nueva imagen
        if($fotoPerfil && $fotoPerfil !== 'default.jpg') {
            
            // Eliminar la imagen anterior si no es 'default.jpg'
            $uploads_dir = '../Assets/img/grups/';
            if($result['image'] && $result['image'] !== 'default.jpg' && file_exists($uploads_dir . $result['image'])) {
                unlink($uploads_dir . $result['image']);
            }
            
            $sql = "UPDATE `grups` SET `titol` = ?, `image` = ? WHERE `nom` = ?";
            
        } elseif($fotoPerfil === 'default.jpg') {
            // Si se selecciona default.jpg, eliminar la imagen existente si no es default.jpg
            $uploads_dir = '../Assets/img/grups/';
            if($result['image'] && $result['image'] !== 'default.jpg' && file_exists($uploads_dir . $result['image'])) {
                unlink($uploads_dir . $result['image']);
            }
            
            $sql = "UPDATE `grups` SET `titol` = ?, `image` = ? WHERE `nom` = ?";
            
        } elseif(!$fotoPerfil && $result['image'] !== 'default.jpg') {
            // Si no se ha subido una nueva imagen y la imagen existente no es default.jpg, no hacer nada
            $sql = "UPDATE `grups` SET `titol` = ? WHERE `nom` = ?";
            
        } else {
            // No se ha subido una nueva imagen o es la misma imagen
            $sql = "UPDATE `grups` SET `titol` = ?, `image` = ? WHERE `nom` = ?";
        }
        
        $stmt = $conection->prepare($sql);
        
        if($fotoPerfil){
            $stmt->bindParam(1, $nomGrup);
            $stmt->bindParam(2, $fotoPerfil);
            $stmt->bindParam(3, $nom);
        } else {
            $stmt->bindParam(1, $nomGrup);
            $stmt->bindParam(2, $nom);
        }
        
        $stmt->execute();
        return true;
        
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

?>