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

function mostrarUsuari(){
    try{
    $conection = connection();
    $sql = "SELECT nom,cognom,edat,curs FROM `usuaris`"; // Replace with your table and column names
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
    $sql = "SELECT nom FROM `usuaris`"; // Replace with your table and column names
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
    $sql = "SELECT nom,cognom,edat,curs FROM `usuaris` ORDER BY nom"; // Replace with your table and column names
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
    $sql = "SELECT nom,cognom,edat,curs FROM `usuaris` ORDER BY curs"; // Replace with your table and column names
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
    $sql = "SELECT nom,cognom,edat,curs FROM `usuaris` ORDER BY edat"; // Replace with your table and column names
    $stmt = $conection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

?>