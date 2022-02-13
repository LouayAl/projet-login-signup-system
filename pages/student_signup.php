<?php
    // Niveaux & filiéres file.
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/niveaux.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/back/entities/filieres.php");

    // Get all values.
    $niveaux = getAllNiveaux();
    $filieres = getAllFilieres();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>S'inscrire</title>
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
			class="panel-body inf-content2 container bootstrap snippets bootdey" id="profile_div"
		>
            <form method="POST" action="/back/functions/f_signup.php">
                <div class="row">
                    <div class="col-md-12">
                        <div id="signup_head_div">
                            <strong>S'inscrire</strong>
                            <button type="submit" class="btn btn-warning" id="return_btn">
                                <span>&larr;</span>
                                Retourner
                            </button>
                        </div>
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
                                            <input type="text" name="cin" placeholder="CIN" required>
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
                                            <input type="text" name="utilisateur" placeholder="Utilisateur" required>
                                        </td>
                                    </tr>

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
                                            <input minlength="5" type="password" name="mot_de_passe" placeholder="Mot de Passe" required>
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
                                            <input type="text" name="nom" placeholder="Nom" required>
                                        </td>
                                    </tr>

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
                                            <input type="text" name="prenom" placeholder="Prénom" required>
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
                                            <input type="tel" name="tel" placeholder="Téléphone">
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
                                            <input type="email" name="email" placeholder="Email">
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
                                            <input type="date" name="date_n" placeholder="Date de Naissance" required>
                                        </td>
                                    </tr>
                                    
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
                                            <input type="text" name="pays" placeholder="Pays">
                                        </td>
                                    </tr>

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
                                            <input type="text" name="ville" placeholder="Ville">
                                        </td>
                                    </tr>
                                    
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
                                                        echo "<option value='$n'>$n</option>";
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    
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
                                                        echo "<option value='$f'>$f</option>";
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <strong>
                                                <span
                                                    class="glyphicon glyphicon-menu-hamburger text-primary"
                                                ></span>
                                                Sexe
                                            </strong>
                                        </td>
                                        <td class="text-primary">
                                            <input type="radio" name="sexe" value="M" checked> M
                                            <input type="radio" name="sexe" value="F" style="margin-left: 10px"> F
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="logout_div">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                            <?php
                                // Display login error.
                                if(isset($_GET['error'])) {
                                    echo("<p id=\"invalid_login\">Il y a des erreurs, ou CIN/Utilisateur est déjà utilisé.</p>");
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</body>
    <script>
        // Variables.
        const return_btn = document.getElementById("return_btn");

        // Events.
        return_btn.addEventListener('click', function() {
            window.location.href = '/pages/student_login.php';
        });
    </script>
</html>
