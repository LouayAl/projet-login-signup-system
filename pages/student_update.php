<?php
    // Check if there is a login.
    session_start();
    if(!isset($_SESSION['student'])) {
        header('location: student_login.php');
    }

    // Etudiants file.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");
    // Niveaux & filiéres file.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/niveaux.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/filieres.php");
    
    // Get all values.
    $niveaux = getAllNiveaux();
    $filieres = getAllFilieres();
    
    // Get student.
    $cin = $_SESSION['student'];
    $student = getStudentByCin($cin);
    
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Mettre à jour du profil</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link
			href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="/public/fonts/NotoSans-Regular.ttf" />
		<link rel="stylesheet" href="/public/fonts/NotoSans-Bold.ttf" />
		<link rel="stylesheet" href="/public/css/dashboard.css" />
        <link
			rel="shortcut icon"
			href="/public/images/favicon.ico"
			type="image/x-icon"
		/>
	</head>
	<body id="profile2">
		<div
			class="panel-body inf-content container bootstrap snippets bootdey" id="profile_div"
		>
            <div id="logout_div">
                <form method="POST" action="/back/functions/logout.php">
                    <button type="submit" class="btn btn-primary">Se déconnecter</button>
                </form>
            </div>
			<div class="row">
				<div class="col-md-4" id="image_div">
					<img
						alt=""
						style="width: 600px"
						title=""
						class="img-circle img-thumbnail isTooltip"
						src="<?php echo $student['image'] ?? '/public/images/users/user.png' ;?>"
					/>
				</div>
				<form method="POST" action="/back/functions/f_update_profile.php">
                <div class="col-md-6">
					<strong style="color: #FFD32D;">Mettre à jour mon profil</strong><br />
					<div class="table-responsive">
						<table class="table table-user-information">
							<tbody>
                                <!-- Nom -->
								<tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-user text-primary"
											></span>
											Nom
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="nom" placeholder="Nom" value="<?php echo $student["nom"] ?>">
									</td>
								</tr>
                                
                                <!-- Prénom -->
								<tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-user text-primary"
											></span>
											Prénom
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $student["prenom"] ?>">
									</td>
								</tr>
								
                                <!-- Utilisateur -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-bookmark text-primary"
											></span>
											Utilisateur
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="utilisateur" placeholder="Utilisateur" value="<?php echo $student["utilisateur"] ?>">
									</td>
								</tr>
                                
                                <!-- Mot de passe -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-eye-close text-primary"
											></span>
											Mot de Passe
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="password" minlength="5" name="mot_de_passe" placeholder="Mot de Passe">
									</td>
								</tr>
								
                                <!-- Téléphone -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-phone text-primary"
											></span>
											Téléphone
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="tel" placeholder="Téléphone" value="<?php echo $student["tel"] ?>">
									</td>
								</tr>
								
                                <!-- Email -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-envelope text-primary"
											></span>
											Email
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="email" placeholder="Email" value="<?php echo $student["email"] ?>">
									</td>
								</tr>
								
                                <!-- Date de naissance -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-calendar text-primary"
											></span>
											Date de Naissance
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="date" name="date_n" placeholder="Date de Naissance" value="<?php echo $student["date_n"] ?>">
									</td>
								</tr>
								
                                <!-- Ville -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-map-marker text-primary"
											></span>
											Ville
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="ville" placeholder="Ville" value="<?php echo $student["ville"] ?>">
									</td>
								</tr>
                                
                                <!-- Pays -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-map-marker text-primary"
											></span>
											Pays
										</strong>
									</td>
									<td class="text-primary">
                                        <input type="text" name="pays" placeholder="Pays" value="<?php echo $student["pays"] ?>">
									</td>
								</tr>
                                
                                <!-- Niveau -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-book text-primary"
											></span>
											Niveau
										</strong>
									</td>
									<td class="text-primary">
                                        <select name="niveau" id="niveau">
                                            <?php
                                                foreach ($niveaux as $n) {
                                                    if($student["niveau"] == $n) {
                                                        echo "<option value='$n' selected>$n</option>";
                                                    } else {
                                                        echo "<option value='$n'>$n</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
									</td>
								</tr>

                                <!-- Filiére -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-book text-primary"
											></span>
											Filiére
										</strong>
									</td>
									<td class="text-primary">
                                        <select name="filiere" id="filiere">
                                            <?php
                                                foreach ($filieres as $f) {
                                                    if($student["filiere"] == $f) {
                                                        echo "<option value='$f' selected>$f</option>";
                                                    } else {
                                                        echo "<option value='$f'>$f</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
									</td>
								</tr>

                                <!-- Sexe -->
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-book text-primary"
											></span>
											Sexe
										</strong>
									</td>
									<td class="text-primary">
                                        <?php
                                            if($student["sexe"] == "m" || $student == "M") {
                                                echo '<input type="radio" name="sexe" value="M" checked> M';
                                                echo '<input type="radio" name="sexe" value="F" style="margin-left: 10px"> F';
                                            } else {
                                                echo '<input type="radio" name="sexe" value="M"> M';
                                                echo '<input type="radio" name="sexe" value="F" checked style="margin-left: 10px"> F';
                                            }
                                        ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                    <!-- Update -->
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <?php
                            // Display login error.
                            if(isset($_GET['error'])) {
                                echo("<p id=\"invalid_login\">Il y a des erreurs, ou Utilisateur est déjà utilisé.</p>");
                            }
                        ?>
                    </div>
				</div>
                </form>
			</div>
		</div>
	</body>
    <script>
        const update_profile_btn = document.getElementById("update_profile_btn");
        update_profile_btn.addEventListener('click', () => {
            window.location.href = './pages/student_update.php';
        });
    </script>
</html>
