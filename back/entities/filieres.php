<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");

    // Obtenir filiere avec id.
    function getFiliere($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "SELECT * FROM filieres WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Filiere.
        $filiere = mysqli_fetch_array($query_result);
        return $filiere;
    }

    // Ajouter filiere.
    function addFiliere($nom) {
        global $conn;

        // Validation.
        $nom = trim($nom);
        if (!isset($nom) || strlen($nom) < 3) {
            return false;
        }

        // Requete.
        $query = "INSERT INTO filieres VALUES ('$nom')";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Mise a jour de filiere.
    function updateFiliere($id, $nom) {
        global $conn;

        // Validation.
        $nom = trim($nom);
        if (!isset($nom) || strlen($nom) < 3) {
            return false;
        }

        // Requete.
        $query = "UPDATE filieres SET nom = '$nom' WHERE id=$id;";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Suppression de filiere.
    function deleteFiliere($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "DELETE FROM filieres WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        return $query_result;
    }

    // Get all filieres.
    function getAllFilieres() {
        $conn = openConnection();

        // Requete.
        $query_result = mysqli_query($conn, "SELECT * FROM filieres;");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiants.
        $filieres = [];
        while($f = mysqli_fetch_assoc($query_result)) {
            array_push($filieres, $f["nom"]);
        }
        return $filieres;
    }

?>