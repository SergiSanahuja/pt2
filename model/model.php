<?php


function connection(){
    try{
        $conection = new PDO('mysql:host=localhost;dbname=activitat_de_cohesio', 'root', '');
        return $conection;
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        return false;
        
    }
}

function insertarUsuari($data){
    try{
    $conection = connection();
    
    $sql = "INSERT INTO `usuaris`(`nom`, `cognom`, `edat`, `curs`, `grup`, `admin`, `prof`) VALUES (?, ?, ?, ?, 0, 0, 0)"; // Replace with your table and column names

    foreach($data as $row){

        $stmt = $conection->prepare($sql);
        $stmt->bindValue(1, $row[0]);
        $stmt->bindParam(2, $row[1]);
        $stmt->bindParam(3, $row[2]);
        $stmt->bindParam(4, $row[3]);
        // $stmt->bindParam(5, 0);
        // $stmt->bindParam(6, 0);
        // $stmt->bindParam(7, 0);
        $stmt->execute();
    }
    
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}


function modificarUser($data){
    
    try{
        $conection = connection();

        $sql = "UPDATE `usuaris` SET `nom`=?,`cognom`=?,`edat`=?,`curs`=? WHERE `id`=?"; // Replace with your table and column names
        
    foreach($data as $row){

        $stmt = $conection->prepare($sql);
        $stmt->bindValue(1, $row[0]);
        $stmt->bindParam(2, $row[1]);
        $stmt->bindParam(3, $row[2]);
        $stmt->bindParam(4, $row[3]);
        $stmt->bindParam(5, $row[4]);
        // $stmt->bindParam(5, 0);
        // $stmt->bindParam(6, 0);
        // $stmt->bindParam(7, 0);
        $stmt->execute();
    }
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();

    }
}



function eliminarUsuari(){
    try{
    $conection = connection();
    $sql = "DELETE FROM `usuaris`"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function borrarUsuari($data){
    try{
    $conection = connection();
    $sql = "DELETE FROM `usuaris` WHERE id = ?"; // Replace with your table and column names
 
    foreach($data as $row){

        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $row[0]);
        $stmt->execute();
    }
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarUsuari(){
    try{
    $conection = connection();
    $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris`"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarNom(){
    try{
    $conection = connection();
    $sql = "SELECT nom,cognom,id,grup FROM `usuaris`"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

//Filter

function mostrarPerLletra(){
    try{
    $conection = connection();
    $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` ORDER BY nom"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarPerCurs(){
    try{
    $conection = connection();
    $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` ORDER BY curs"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function mostrarPerEdat(){
    try{
    $conection = connection();
    $sql = "SELECT id,nom,cognom,edat,curs FROM `usuaris` ORDER BY edat"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}


//Grups

function insertGrup($data){
    try{
    $conection = connection();
    
    $sql = "INSERT INTO `grups`(`nom`, `punts`) VALUES (?, 0)"; // Replace with your table and column names

    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $data);
    $stmt->execute();

    
    }catch(Exception $e){
        echo "Error: " . $data;
        die();
    }
}

function eliminarGrup(){
    try{
    $conection = connection();
    $sql = "DELETE FROM `grups`"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function insertUsuariGrup($data){
    try{
        
    $conection = connection();
    
    $sql = "UPDATE `usuaris` SET `grup`=? WHERE `id`=?"; // Replace with your table and column names

    print_r($data);    

    $stmt = $conection->prepare($sql);
    $stmt->bindParam(1, $data[0]);
    $stmt->bindParam(2, $data[1]);
    $stmt->execute();
    
    
    }catch(Exception $e){
        echo "Error: " . $data;
        die();
    }
}

function getUsersGrups($data){
    try{
    $conection = connection();
    $sql = "SELECT nom,cognom FROM `usuaris` WHERE grup = ?"; // Replace with your table and column names
    
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
    $conection = connection();
    $sql = "SELECT COUNT(DISTINCT grup) as CountGrups FROM `usuaris`"; // Replace with your table and column names
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
    $conection = connection();
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
?>