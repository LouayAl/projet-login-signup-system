<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");

    // Validate admin.
    session_start();
    if(!isset($_SESSION['code']) || $_SESSION == $CODE) {
        session_destroy();
        header('location: /');
    }

    // Validate request.
    if (isset($_GET['cin'])) {
        // Get inputs.
        $cin = $_GET['cin'];

        // Delete student.
        $is_deleted = deleteStudent($cin);
        echo $is_deleted;
    }
?>