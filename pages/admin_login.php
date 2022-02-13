<?php
    // Check if there is a login.
    session_start();
    if(isset($_SESSION['code'])) {
        header('location: administration.php');
    }
    if(isset($_SESSION['student'])) {
        header('location: dashboard.php');
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
		<link rel="stylesheet" href="/public/css/style.css" />
		<link rel="stylesheet" href="/public/css/login.css" />
	</head>
	<body>
		<div class="main-center center">
			<form
				id="admin_form"
                class="login_form"
				action="/back/functions/f_admin_login.php"
				method="POST"
			>
				<div class="center">
					<p>Connectez-vous à votre compte administrateur</p>
					<input
						type="email"
						name="admin_email"
						placeholder="Email"
						required
					/><br />
					<input
						type="password"
						name="admin_password"
						placeholder="Mot de passe"
                        autocomplete="on"
						required
					/><br />
					<button type="submit">Login</button>
                    <?php
                        // Display login error.
                        if(isset($_GET['error'])) {
                            echo("<p id=\"invalid_login\">Email ou mot de passe incorrect</p>");
                        }
                    ?>
                    <p id="return_login">
                        <span>&larr;</span>
                        Retourner
                    </p>
				</div>
			</form>
		</div>
	</body>
    <!-- Particles -->
	<script src="/public/js/particles.min.js"></script>
	<script src="/public/js/particles_init.js"></script>

    <!-- Script -->
    <script>
        let retourner_btn = document.getElementById("return_login");
        retourner_btn.addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>
</html>
