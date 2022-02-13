<?php
    // Connection.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/connection.php");

    // Validate admin login.
    session_start();
    if(!isset($_SESSION['code']) || $_SESSION['code'] != $CODE) {
        session_destroy();
        header('location: /');
    }
?>

<!DOCTYPE html>
<html lang="fr" id="particles-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="shortcut icon"
			href="/public/images/favicon.ico"
			type="image/x-icon"
		/>
		<title>Administration</title>
		<link rel="stylesheet" href="/public/fonts/NotoSans-Regular.ttf" />
		<link rel="stylesheet" href="/public/fonts/NotoSans-Bold.ttf" />
		<link rel="stylesheet" href="/public/css/dashboard.css" />
		<link rel="stylesheet" href="/public/css/admin_dashboard.css" />
	</head>
	<body>
		<div class="center">
            <div>
                <button id="admin_etudiants" type="submit" class="admin_btns" title="Voir la liste des étudiants inscrits.">Étudiants</button>
            </div>
            <div>
                <button id="admin_notes" type="submit" class="admin_btns" title="Modifier les notes des élèves">Notes</button>
            </div>
            <div>
                <form method="POST" action="/back/functions/logout.php">
                    <button id="admin_logout" type="submit" class="admin_btns">Se déconnecter</button>
                </form>
            </div>
		</div>
	</body>
    <!-- Particles -->
	<script src="/public/js/particles.min.js"></script>
	<script src="/public/js/particles_init.js"></script>
    <!-- Script -->
    <script>
        const etudiants_btn = document.getElementById('admin_etudiants');
        etudiants_btn.addEventListener('click', function() {
            window.location.href = '/pages/admin_students.php';
        });
    </script>
</html>
