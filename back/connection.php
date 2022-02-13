<?php
    // Inclus de config.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/config.php");

    // Essayer de connecter.
    $conn = mysqli_connect($db_server_name, $db_user_name, $db_password, $db_name);
    if (mysqli_connect_errno()) {
        die("Erreur de connection: " . mysqli_connect_errno());
        exit();
    }

    // Open connection.
    function openConnection() {
        global $db_server_name, $db_user_name, $db_password, $db_name;
        $conn = mysqli_connect($db_server_name, $db_user_name, $db_password, $db_name);
        if (mysqli_connect_errno()) {
            die("Erreur de connection: " . mysqli_connect_errno());
            exit();
        }
        return $conn;
    }
?>