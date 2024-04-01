<?php
require_once 'connexio.php';

function comprovarAdmin($email){
    try {
        $conection = connexio();
        $sql = "SELECT `admin` FROM `usuaris` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['admin'] == 1){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function comprovarProf($email){
    try {
        $conection = connexio();
        $sql = "SELECT `prof` FROM `usuaris` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['prof'] == 1){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function getUserByEmail($email){
    try {
        $conection = connexio();
        $sql = "SELECT `email` FROM `usuaris` WHERE `email` = ?";
        
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
        $sql = "SELECT `password` FROM `usuaris` WHERE `email` = ?";
        
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

?>