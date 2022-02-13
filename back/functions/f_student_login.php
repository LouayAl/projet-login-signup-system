<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");

    // Validate.
    if (isset($_POST['student_id']) && isset($_POST['student_password'])) {
        // Get inputs.
        $student_id = $_POST['student_id'];
        $student_password = $_POST['student_password'];

        // Validate login.
        $is_correct = login($student_id, $student_password);
        
        // Redirect.
        if ($is_correct) {
            // Set session.
            session_start();
            $_SESSION['student'] = $is_correct["cin"];

            // Redirect
            header('location: /pages/student_profil.php');

        } else {
            // Return to login.
            header('location: /pages/student_login.php?error=true');
        }
    }
?>