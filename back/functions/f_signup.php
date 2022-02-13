<?php

    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");

    // Get inputs.
    $cin = $_POST['cin'];
    $user = $_POST['utilisateur'];
    $pass = $_POST['mot_de_passe'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $date_n = $_POST['date_n'];
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $niveau = $_POST['niveau'];
    $filiere = $_POST['filiere'];
    $sexe = $_POST['sexe'];

    // Validate login.
    $is_correct = addStudent($cin, $user, $pass, $nom, $prenom, $email, $date_n, $tel, $pays, $ville, $sexe, $niveau, $filiere);

    // Redirect.
    if ($is_correct) {
        // Set session.
        session_start();
        $_SESSION['student'] = $cin;

        // Redirect
        header('location: /pages/student_profil.php');

    } else {
        // Return to login.
        header('location: /pages/student_signup.php?error=true');
    }
?>