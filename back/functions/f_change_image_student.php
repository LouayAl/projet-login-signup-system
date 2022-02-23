<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");

    // Validate request.
    session_start();
    if (isset($_SESSION['student'])) {
        // Get inputs.
        $cin = $_SESSION['student'];
        $image = $_POST['image'];
        $extension = $_POST['extension'];

        // File name.
        $file_name = addslashes("/public/images/users/$cin.$extension");
        $file_name_save = $_SERVER["DOCUMENT_ROOT"] . "/public/images/users/$cin.$extension";

        // Change profile picture in db.
        $result = addProfilPicture($cin, "image", $file_name);

        // Save image.
        file_put_contents($file_name_save, base64_decode($image));

        echo $result;
    } else {
        echo false;
    }
?>