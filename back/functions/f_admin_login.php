<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/admin.php");

    // Validate.
    if (isset($_POST['admin_email']) && isset($_POST['admin_password'])) {
        // Get inputs.
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];

        // Validate login.
        $is_correct = admin_login($admin_email, $admin_password);
        
        // Redirect.
        if ($is_correct) {
            // Set session.
            session_start();
            $_SESSION['code'] = $CODE;

            // Redirect
            header('location: /pages/administration.php');

        } else {
            // Return to login.
            header('location: /pages/admin_login.php?error=true');
        }
    }
?>