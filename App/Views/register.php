<?php
// Si une requête POST a été faite, définis les valeurs pour chaque champ
$nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
$mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '';
$ddn = isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : '';
$genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';
$mdp1 = isset($_POST['mdp1']) ? htmlspecialchars($_POST['mdp1']) : '';
$mdp2 = isset($_POST['mdp2']) ? htmlspecialchars($_POST['mdp2']) : '';
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Dr Dupont - S'enregistrer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<p>Enregistrez vous pour faciliter vos prises de rendez vous</p>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>

                                <section id="banner">
                                    <div id="register" class="row content">
                                        <form method="POST" action="#">
                                            <div class="row">
												<div class="col-6">
													<input tabindex="1" type="text" name="nom" placeholder="Nom" value="<?php echo $nom; ?>" required>
													<input tabindex="3" type="date" name="date_naissance" value="<?php echo $ddn; ?>">
												</div>
												<div class="col-6">
													<input tabindex="2" type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom; ?>" required>
													<select tabindex="4" class="col-6" name="genre" required>
														<option value=""></option>
														<option value="Homme" <?php if ($genre === 'Homme') echo 'selected'; ?>>Homme</option>
														<option value="Femme" <?php if ($genre === 'Femme') echo 'selected'; ?>>Femme</option>
													</select>
												</div>
												<div class="col-12">
													<input tabindex="5" type="text" name="mail" placeholder="Adresse mail" value="<?php echo $mail; ?>" required>
												</div>
												<div class="col-6">
													<input tabindex="6" type="password" name="mdp1" placeholder="Mot de passe" value="<?php echo $mdp1; ?>" required>
												</div>
												<div class="col-6">
													<input tabindex="7" type="password" name="mdp2" placeholder="Retapez votre mot de passe" value="<?php echo $mdp2; ?>" required>
												</div>
                                            </div>
                                            <div class="align-center"><input tabindex="7" class="send" type="submit" style="margin-top:1.5em;" value="S'inscrire"></div>
                                        </form>
                                    </div>
                                </section>
                            
						</div>
					</div>

                    

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<div class="align-center" style="display: flex; justify-content: center; gap: 2em;">
										<a href="login" style="border: none;">Se connecter</a>
										<a href="register" style="border: none;">S'enregistrer</a>
									</div>
								</section>

							<!-- Menu -->
							<nav id="menu">
								<header class="major">
									<h2>Menu</h2>
								</header>
								<ul>
									<li><a href="/">Accueil</a></li>
									<?php if ((!empty($_SESSION)) && $_SESSION['user_admin'] === 1): ?>
										<li><a href="rendezvousAdmin">Vos rendez-vous</a></li>
									<?php else: ?>
										<li><a href="rendezvous">Prendre rendez-vous</a></li>
									<?php endif; ?>
									<li><a href="services">Nos services</a></li>
									<li><a href="about">A propos</a></li>
									<li><a href="actus">Actualités</a></li>
								</ul>
							</nav>

						
						<!-- Section -->
							<section>
								<header class="major">
									<h2>Horaires</h2>
								</header>
								<p>
									<?php 
										foreach ($horaires as $horaire) {
											if(!empty($horaire['H_debut_am']) && !empty($horaire['H_fin_am'])) {

												echo $horaire['jour'] . ' : ' . substr($horaire['H_debut_am'], 0, 5) .  ' à ' . substr($horaire['H_fin_am'], 0, 5);

												if(!empty($horaire['H_debut_pm']) && !empty($horaire['H_fin_pm'])) {

													echo ' | ' . substr($horaire['H_debut_pm'], 0, 5) . ' à ' . substr($horaire['H_fin_pm'], 0, 5);
													echo "<br>";
												} else {
													echo "<br>";
												}

												} else if(!empty($horaire['H_debut_pm']) && !empty($horaire['H_fin_pm'])) {

													echo $horaire['jour'] . ' : ' . substr($horaire['H_debut_pm'], 0, 5) . ' à ' . substr($horaire['H_fin_pm'], 0, 5);
													echo "<br>";

												} else {

													echo $horaire['jour'] . ' : Fermé';
													echo "<br>";
											}
										} 
									?>
								</p>
								<ul class="contact">
									<li class="icon solid fa-envelope"><a href="#">information@dupontcabinet.fr</a></li>
									<li class="icon solid fa-phone">05.01.02.03.04</li>
									<li class="icon solid fa-home">123 rue Sans nom<br />
									Toulouse, 31400</li>
								</ul>
							</section>

						<!-- Footer -->
							<footer id="footer">
								<p class="copyright">&copy; Docteur Dupont. All rights reserved. </p>
							</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

		<?php if (!empty($error)): ?>
			<script>
				document.getElementById('errorMessage').innerText = "<?php echo htmlspecialchars($error); ?>";
				document.getElementById('errorModal').style.display = 'flex';
			</script>
		<?php endif; ?>

		<!-- Modale pour afficher les erreurs -->
		<div id="errorModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span id="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Erreur</h2>
				<p id="errorMessage"></p>
			</div>
		</div>

		<?php if (!empty($error)): ?>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					document.getElementById('errorMessage').innerText = "<?php echo htmlspecialchars($error); ?>";
					document.getElementById('errorModal').style.display = 'flex'; // Affiche la modale
				});
			</script>
		<?php endif; ?>

		<script>
			// Fermer la modale lorsque l'utilisateur clique sur la croix
			document.addEventListener("DOMContentLoaded", function() {
				document.getElementById('closeModal').onclick = function() {
					document.getElementById('errorModal').style.display = 'none'; // Ferme la modale
				};
			});

			// Fermer la modale si l'utilisateur clique en dehors de la boîte de dialogue
			window.onclick = function(event) {
				if (event.target == document.getElementById('errorModal')) {
					document.getElementById('errorModal').style.display = 'none'; // Ferme la modale
				}
			};
		</script>
	</body>
</html>