<?php
    // Etudiants file.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");

    // Validate admin login.
    session_start();
    if(!isset($_SESSION['code']) || $_SESSION == $CODE) {
        session_destroy();
        header('location: /');
    }

    // Get all students.
    $students = getAllStudents();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="shortcut icon"
			href="/public/images/favicon.ico"
			type="image/x-icon"
		/>
		<title>Administration - Étudiants</title>
		<link rel="stylesheet" href="/public/fonts/NotoSans-Regular.ttf" />
		<link rel="stylesheet" href="/public/fonts/NotoSans-Bold.ttf" />
		<link rel="stylesheet" href="/public/css/dashboard.css" />
		<link rel="stylesheet" href="/public/css/table.css" />
	</head>
	<body>
		<div class="table_container">
            <p id="return_btn">
                <span>&larr;</span>
                Retourner
            </p>
			<div class="table">
				<div class="row header blue">
					<div class="cell">CIN</div>
					<div class="cell">Nom et Prénom</div>
					<div class="cell">Email</div>
					<div class="cell">Date de Naissance</div>
					<div class="cell">Télephone</div>
					<div class="cell">Pays et Ville</div>
					<div class="cell">Sexe</div>
					<div class="cell">Niveau</div>
					<div class="cell">Filiére</div>
					<div class="cell">Image</div>
                    <div class="cell">Supprimer</div>
				</div>

                <?php
                    if (count($students) < 1) {
                ?>
                    <div class="row">
                        <div class="cell" data-title="CIN">....</div>
                        <div class="cell" data-title="Nom et Prénom">...</div>
                        <div class="cell" data-title="Email">...</div>
                        <div class="cell" data-title="Date de Naissance">....</div>
                        <div class="cell" data-title="Télephone">...</div>
                        <div class="cell" data-title="Pays et Ville">...</div>
                        <div class="cell" data-title="Sexe">...</div>
                        <div class="cell" data-title="Niveau">...</div>
                        <div class="cell" data-title="Filiére">....</div>
                        <div class="cell" data-title="Image">...</div>
                        <div class="cell" data-title="Supprimer">...</div>
                    </div>
                <?php } ?>

                <!-- Data -->
                <?php
                    foreach ($students as $e) {
                        // Tag.
                        $tag = '<div class="cell" data-title=';

                        // Données.
                        $nom_pr = $e["nom"] . " " . $e["prenom"];
                        $pays_v = $e["ville"] . ", " . $e["pays"];
                        //$image_path = $_SERVER["DOCUMENT_ROOT"] . $e["image"];
                        $image_path = $e["image"] ?? "/public/images/users/user.png";
                        $image = "<img src='$image_path' class='users_images'>";

                        // Delete tag.
                        $delete_tag = '<div class="cell delete_tag" data-title="Supprimer" id="';
                        $delete_tag .= $e["cin"] . '"> X </div>';

                        // Html.
                        echo '<div class="row">';
                        echo $tag . '"CIN">' . $e["cin"] . '</div>';
                        echo $tag . '"Nom et Prénom">' . $nom_pr . '</div>';
                        echo $tag . '"Email">' . $e["email"] . '</div>';
                        echo $tag . '"Date de Naissance">' . ($e["date_n"] ?? "-") . '</div>';
                        echo $tag . '"Télephone">' . ($e["tel"] ?? "-") . '</div>';
                        echo $tag . '"Pays et Ville">' . ($pays_v ?? "-") . '</div>';
                        echo $tag . '"Sexe">' . ($e["sexe"] ?? "-") . '</div>';
                        echo $tag . '"Niveau">' . ($e["niveau"] ?? "-") . '</div>';
                        echo $tag . '"Filiére">' . ($e["filiere"] ?? "-") . '</div>';
                        echo $tag . '"Image">' . $image . '</div>';
                        echo $delete_tag;
                        echo '</div>';
                    }
                ?>
			</div>
		</div>
	</body>
    <script>
        // Delete student function.
        function deleteStudent(cin) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response) {
                        alert("Supprimé avec succès!");
                    } else {
                        alert("Une erreur s'est produite, veuillez réessayer.");
                    }
                    window.location.reload();
                }
            };
            xmlhttp.open("GET", "/back/functions/f_delete_student.php?cin=" + cin, true);
            xmlhttp.send();
        }

        // Delete.
        const delete_tags = document.getElementsByClassName("delete_tag");
        for (const dt of delete_tags) {
            dt.addEventListener('click', function() {
                let cin = this.id;
                let answer = window.confirm("Êtes-vous sûr de vouloir supprimer cet étudiant?");
                if (answer) {
                    deleteStudent(cin);
                }
            })
        }

        // Retourne.
        let retourner_btn = document.getElementById("return_btn");
        retourner_btn.addEventListener('click', function() {
            window.location.href = '/pages/administration.php';
        });
    </script>
</html>
