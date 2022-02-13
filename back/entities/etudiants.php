<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");

    // Get all students.
    function getAllStudents() {
        global $conn;

        // Requete.
        $query_result = mysqli_query($conn, "SELECT * FROM etudiants;");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiants.
        $etudiants = [];
        while($e = mysqli_fetch_assoc($query_result)) {
            array_push($etudiants, $e);
        }
        return $etudiants;
    }

    // Obtenir etudiant avec cin.
    function getStudentByCin($cin) {
        $conn = openConnection();

        // Requete.
        $cin = addslashes($cin);
        $query_result = mysqli_query($conn, "SELECT * FROM etudiants WHERE cin = '$cin';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiant.
        $etudiant = mysqli_fetch_array($query_result);
        return $etudiant;
    }
    
    // Obtenir etudiant avec utilisateur.
    function getStudentByUser($user) {
        $conn = openConnection();

        // Requete.
        $cin = addslashes($user);
        $query_result = mysqli_query($conn, "SELECT * FROM etudiants WHERE utilisateur = '$user';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiant.
        $etudiant = mysqli_fetch_array($query_result);
        return $etudiant;
    }

    // Ajouter etudiant.
    function addStudent($cin, $user, $pass, $nom, $prenom, $email, $dtn, $tel, $pays, $vl, $sexe, $niveau, $filiere) {
        $conn = openConnection();

        // Validation.
        // Requis.
        if (!isset($cin) || !isset($user) || !isset($pass)) {
            return false;
        }

        // Cin et utilisateur.
        $cin_valid = getStudentByCin($cin);
        $user_valid = getStudentByUser($user);
        if (isset($cin_valid) || isset($user_valid)) {
            return false;
        }

        // Mot de passe.
        if (strlen($pass) < 5) {
            return false;
        }
        // Hash.
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // Email.
        if(isset($email) && strlen($email) > 0) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
        }

        // Date de naissance.
        /*if(isset($dtn)) {
            if (DateTime::createFromFormat('d/m/Y', $dtn) !== true) {
                return false;
            }
        }*/

        // Sexe.
        if (isset($sexe)) {
            if ($sexe !== 'M' && $sexe !== 'F') {
                return false;
            }
        }

        // Date.
        $query = "INSERT INTO etudiants (cin, utilisateur, mot_de_passe, nom, prenom, email, date_n, tel, pays, ville, sexe, niveau, filiere) VALUES ";
        if(!isset($dtn) || !$dtn) {
            $query .= "('$cin', '$user', '$pass', '$nom', '$prenom', '$email', null, '$tel', '$pays', '$vl', '$sexe', '$niveau', '$filiere');";
        } else {
            $query .= "('$cin', '$user', '$pass', '$nom', '$prenom', '$email', '$dtn', '$tel', '$pays', '$vl', '$sexe', '$niveau', '$filiere');";
        }

        // Requete.
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Mise a jour d'etudiant.
    function updateStudent($cin, $user, $pass, $nom, $prenom, $email, $dtn, $tel, $pays, $vl, $sexe) {
        global $conn;

        // Validation.
        // Requis.
        if (!isset($cin) || !isset($user) || !isset($pass)) {
            return false;
        }

        // Cin existe.
        $etudiant = getStudentByCin($cin);
        if (!isset($etudiant)) {
            return false;
        }

        // Valider utilisateur.
        if ($etudiant["utilisateur"] !== $user) {
            $user_valid = getStudentByUser($user);
            if(isset($user_valid)) {
                return false;
            }
        }

        // Mot de passe.
        if (strlen($pass) < 5) {
            return false;
        }
        // Hash.
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // Email.
        if(isset($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
        }

        // Date de naissance.
        if(isset($dtn)) {
            if (DateTime::createFromFormat('d/m/Y', $dtn) !== true) {
                return false;
            }
        }

        // Sexe.
        if (isset($sexe)) {
            if ($sexe !== 'm' && $sexe !== 'f') {
                return false;
            }
        }

        // Requete.
        $query = "UPDATE etudiants SET utilisateur = '$user', mot_de_passe = '$pass', nom = '$nom', " .
                "prenom = '$prenom', email = '$email', date_de_naissance = '$dtn', " .
                "tel = '$tel', pays = '$pays', ville = '$vl', sexe = '$sexe' WHERE cin = '$cin';";
        $query_result = mysqli_query($conn, $query);

        // Fermer la connection.
        mysqli_close($conn);

        // Result.
        if (!$query_result) {
            return false;
        }
        return true;
    }

    // Suppression d'etudiant.
    function deleteStudent($cin) {
        global $conn;

        // Requete.
        $cin = addslashes($cin);
        $query_result = mysqli_query($conn, "DELETE FROM etudiants WHERE cin = '$cin';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        return $query_result;
    }

    // Ajouter image.
    function addProfilPicture($cin, $type, $image) {
        $conn = openConnection();

        // Valider etudiant.
        $etudiant = getStudentByCin($cin);
        if(!isset($etudiant)) {
            return false;
        }

        // Delete old picture.
        if(isset($etudiant["image"])) {
            $result = unlink($_SERVER["DOCUMENT_ROOT"] . $etudiant["image"]);
            if (!$result) {
                return false;
            }
        }

        // Requete.
        $query_result = mysqli_query($conn, "UPDATE etudiants SET $type = '$image' WHERE cin = '$cin';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!$query_result) {
            return false;
        }

        // All is done.
        return true;
    }

    // Login.
    function login($id, $password) {    
        global $conn;

        // Requete.
        $id = addslashes($id);
        $query_result = mysqli_query($conn, "SELECT * FROM etudiants WHERE cin = '$id' OR utilisateur = '$id';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Etudiant.
        $etudiant = mysqli_fetch_array($query_result);

        // Verifier mot de passe.
        if(password_verify($password, $etudiant["mot_de_passe"])) {
            return $etudiant;
        }

        return false;
    }

    /*$result = getStudentByCin("h1");
    if (!isset($result)) {
        echo("Not found");
    } else {
        echo $result["mot_de_passe"];
    }*/

?>