<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");

    // Login.
    function admin_login($email, $password) {    
        global $conn;

        // Requete.
        $email = addslashes($email);
        $query_result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email';");

        // Fermer la connection.
        mysqli_close($conn);

        // Data.
        if (!mysqli_num_rows($query_result)) {
            return null;
        }

        // Admin.
        $admin = mysqli_fetch_array($query_result);

        // Verifier mot de passe.
        if(password_verify($password, $admin["mot_de_passe"])) {
            return true;
        }

        return false;
    }

?>