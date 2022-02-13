<?php
    // Check if there is a login.
    session_start();
    if(!isset($_SESSION['student'])) {
        header('location: student_login.php');
    }

    // Etudiants file.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/etudiants.php");
    
    // Get student.
    $cin = $_SESSION['student'];
    $student = getStudentByCin($cin);
    
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Mon Profil</title>
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
	<body id="profile">
		<div
			class="panel-body inf-content container bootstrap snippets bootdey" id="profile_div"
		>
			<div class="row">
				<div class="col-md-4" id="image_div">
					<img
						alt=""
						style="width: 600px"
						title=""
						class="img-circle img-thumbnail isTooltip"
						src="<?php echo $student['image'] ?? '/public/images/users/user.png' ;?>"
					/>
                    <br><br>
                    <input type="file" id="profile_image_input" style="display: none;">
                    <button type="button" class="btn btn-success" id="profile_image_btn">Modifier la photo de profil</button>
				</div>
				<div class="col-md-6">
					<strong>Mon Profil</strong><br />
					<div class="table-responsive">
						<table class="table table-user-information">
							<tbody>
								<tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-asterisk text-primary"
											></span>
											CIN
										</strong>
									</td>
									<td class="text-primary">
										<?php echo $student["cin"]; ?>
									</td>
								</tr>
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
										<?php
                                            echo $student["nom"] . " " . $student["prenom"]; 
                                        ?>
									</td>
								</tr>
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
										<?php echo $student["utilisateur"]; ?>
									</td>
								</tr>
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
										<?php echo $student["cin"]; ?>
									</td>
								</tr>
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
										<?php echo $student["email"]; ?>
									</td>
								</tr>
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
										<?php echo $student["date_n"]; ?>
									</td>
								</tr>
								
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-map-marker text-primary"
											></span>
											Pays et Ville
										</strong>
									</td>
									<td class="text-primary">
										<?php echo $student["ville"] . ", " . $student["pays"]; ?>
									</td>
								</tr>
                                
                                <tr>
									<td>
										<strong>
											<span
												class="glyphicon glyphicon-book text-primary"
											></span>
											Niveau et Filiére
										</strong>
									</td>
									<td class="text-primary">
										<?php echo $student["niveau"] . " - " . $student["filiere"]; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                    <div id="logout_div">
                        <form method="POST" action="/back/functions/logout.php">
                            <button type="submit" class="btn btn-primary">Se déconnecter</button>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</body>
    <script>
        // Variables.
        const profile_image_input = document.getElementById("profile_image_input");
        const profile_image_btn = document.getElementById("profile_image_btn");

        // Events.
        profile_image_btn.addEventListener('click', function() {
            profile_image_input.click();
        });
        profile_image_input.addEventListener('change', function() {
            imageB64(profile_image_input['files'][0], profile_image_input.value.split('.').pop());
        });

        // Convert to base64.
        function imageB64(image, extension) {
            let reader = new FileReader();
            
            reader.onload = function () {
                let base64String = reader.result;
                let imageBase64Stringsep = base64String.replace("data:", "")
                    .replace(/^.+,/, "");

                // Send image to server.
                sendImage(imageBase64Stringsep, extension);
            }
            reader.readAsDataURL(image);
        }

        // Send image.
        function sendImage(imageData, extension) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                    if(!this.response) {
                        alert("Une erreur s'est produite, veuillez réessayer.");
                    }
                    else {
                        window.location.reload();
                    }
                }
            };
            xmlhttp.open("POST", "/back/functions/f_change_image_student.php", true);

            // Request data.
            let formData = new FormData();
            formData.append('image', imageData);
            formData.append('extension', extension);

            // Send.
            xmlhttp.send(formData);
        }
    </script>
</html>
