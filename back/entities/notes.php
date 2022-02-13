<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/etudiants.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/niveaux.php");

    // Obtenir note avec id.
    function getNote($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "SELECT * FROM notes WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Note.
        $note = mysqli_fetch_array($query_result);
        return $note;
    }

    // Ajouter note.
    function addNote($cin, $id_niveau, $note_s1, $note_s2) {
        global $conn;

        // Validation de CIN.
        $cin = trim($cin);
        $cin_valid = getStudentByCin($cin);
        if (!isset($cin_valid)) {
            return false;
        }

        // Validation de niveau.
        $niveau_valid = getNiveau($id_niveau);
        if (!isset($niveau_valid)) {
            return false;
        }

        // Validation des notes.
        if (isset($note_s1)) {
            if(!filter_var($note_s1, FILTER_VALIDATE_FLOAT) || ($note_s1 < 0 || $note_s1 > 20)) {
                return false;
            }
        }
        if (isset($note_s2)) {
            if(!filter_var($note_s2, FILTER_VALIDATE_FLOAT) || ($note_s2 < 0 || $note_s2 > 20)) {
                return false;
            }
        }

        // Requete.
        $query = "INSERT INTO notes VALUES ('$cin', $id_niveau, $note_s1, $note_s2)";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Mise a jour de note.
    function updateNote($id, $note_s1, $note_s2) {
        global $conn;

        // Note existe.
        $note = getNote($id);
        if (!isset($note)) {
            return false;
        }

        // Validation des notes.
        if (isset($note_s1)) {
            if(!filter_var($note_s1, FILTER_VALIDATE_FLOAT) || ($note_s1 < 0 || $note_s1 > 20)) {
                return false;
            }
        }
        if (isset($note_s2)) {
            if(!filter_var($note_s2, FILTER_VALIDATE_FLOAT) || ($note_s2 < 0 || $note_s2 > 20)) {
                return false;
            }
        }

        // Requete.
        $query = "UPDATE notes SET note_s1=$note_s1, note_s2=$note_s2 WHERE id=$id;";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Suppression de note.
    function deNote($id) {
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "DELETE FROM notes WHERE id = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        return $query_result;
    }

?>