<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");

    // Obtenir niveau avec id.
    function getNiveau($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "SELECT * FROM niveaux WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Niveau.
        $niveau = mysqli_fetch_array($query_result);
        return $niveau;
    }

    // Ajouter niveau.
    function addNiveau($nom) {
        global $conn;

        // Validation.
        $nom = trim($nom);
        if (!isset($nom) || strlen($nom) < 3) {
            return false;
        }

        // Requete.
        $query = "INSERT INTO niveaux VALUES ('$nom')";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Mise a jour de niveau.
    function updateNiveau($id, $nom) {
        global $conn;

        // Validation.
        $nom = trim($nom);
        if (!isset($nom) || strlen($nom) < 3) {
            return false;
        }

        // Requete.
        $query = "UPDATE niveaux SET nom = '$nom' WHERE id=$id;";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Suppression de niveau.
    function deleteNiveau($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "DELETE FROM niveaux WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        return $query_result;
    }

    // Get all niveaux.
    function getAllNiveaux() {
        $conn = openConnection();

        // Requete.
        $query_result = mysqli_query($conn, "SELECT * FROM niveaux;");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiants.
        $niveaux = [];
        while($n = mysqli_fetch_assoc($query_result)) {
            array_push($niveaux, $n["nom"]);
        }
        return $niveaux;
    }

?>