<?php
require_once 'connexio.php';

function consultarProfes(){
    try {
        $conection = connexio();
        $sql = "SELECT `id`, `nom`, `cognom`, `email` FROM `usuaris` WHERE `prof` = 1";
        
        $stmt = $conection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function afegirProfesBD($nom, $cognom, $email, $password){
    try {
        $conection = connexio();
        $sql = "SELECT COUNT(*) FROM `usuaris` WHERE `email` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        if ($result > 0) {
            echo "<script>alert('El professor amb el correu $email ja existeix');</script>";
        }else{
            $conection = connexio();
            $sql = "INSERT INTO `usuaris` (`nom`, `cognom`, `email`, `password`, `prof`) VALUES (?, ?, ?, ?, 1)";
            
            $stmt = $conection->prepare($sql);
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $cognom);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->execute();
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function modificarProfesBD($id, $nom, $cognom, $email, $password){
    try {
        $conection = connexio();
        $sql = "SELECT COUNT(*) FROM `usuaris` WHERE `id` = ?";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        if ($result > 0) {
            $conection = connexio();
            
            // Construct the SQL query based on which fields were provided
            $sql = "UPDATE `usuaris` SET ";
            $params = [];
            
            if (!empty($nom)) {
                $sql .= "`nom` = ?, ";
                $params[] = $nom;
            }
            if (!empty($cognom)) {
                $sql .= "`cognom` = ?, ";
                $params[] = $cognom;
            }
            if (!empty($email)) {
                $sql .= "`email` = ?, ";
                $params[] = $email;
            }
            if (!empty($password)) {
                $sql .= "`password` = ?, ";
                $params[] = $password;
            }

            // Remove trailing comma and space
            $sql = rtrim($sql, ', ');

            $sql .= " WHERE `id` = ?";
            $params[] = $id;

            $stmt = $conection->prepare($sql);

            // Bind parameters dynamically
            for ($i = 0; $i < count($params); $i++) {
                $stmt->bindParam($i + 1, $params[$i]);
            }

            $stmt->execute();
            
        } else {
            echo "<script>alert('El professor amb l'ID $id no existeix');</script>";
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
        die();
    }
}

function eliminarProfesBD($id){
    try {
        $conection = connexio();
        $sql = "SELECT COUNT(*) FROM `usuaris` WHERE `id` = ? AND `prof` = 1";
        
        $stmt = $conection->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        if ($result > 0) {
            $sql = "DELETE FROM `usuaris` WHERE `id` = ?";
            
            $stmt = $conection->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            echo json_encode(array("success" => true, "message" => "Professor eliminat correctament"));
        } else {
            echo json_encode(array("success" => false, "message" => "El professor amb l'ID $id no existeix"));
        }
    } catch(Exception $e){
        echo json_encode(array("success" => false, "message" => "Error: " . $e->getMessage()));
    }
}

?>
