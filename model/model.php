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
        $sql = "DELETE FROM `usuaris` where prof=0";
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
        $sql = "INSERT INTO `grups`(`nom`, `punts`,`email`,`password`) VALUES (?, 0, ?, ?)";

        $stmt = $conection->prepare($sql);
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

function createUser($email, $password){
    try {
        $conection = connexio();
        $sql = "INSERT INTO `login`(`email`, `password`) VALUES (?, ?)";
        
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
        $sql = "SELECT nom,cognom FROM `usuaris` WHERE grup = ? and prof=0"; // Replace with your table and column names
    
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
    $sql = "SELECT COUNT(nom) as CountGrups FROM `grups`"; // Replace with your table and column names
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
    $sql = "SELECT * FROM `grups`"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}


function canviarGrup($data){
    try{
    $conection = connexio();
    $sql = "UPDATE `usuaris` SET `grup`=? WHERE `id`=?"; // Replace with your table and column names


    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $data->idGrup);
    $stmt->bindParam(2, $data ->idUser);
    $stmt->execute();

    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getUserByEmail($email){
    try {
        $conection = connexio();
        $sql = "SELECT `email` FROM `login` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getPasswordByEmail($email){
    try {
        $conection = connexio();
        $sql = "SELECT `password` FROM `login` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return $result['password'];
        } else {
            return false;
        }

    } catch(Exception $e){
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
?>