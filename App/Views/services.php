<!DOCTYPE HTML>
<html>
	<head>
		<title>Dr Dupont - Les services</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<script src="https://cdn.tiny.cloud/1/wtwbmd81pel37li9dr1bqsj4nzorf4zopingy5kqg2gn3vvk/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Main -->
			<div id="main">
				<div class="inner">

					<!-- Header -->
					<header id="header">
						<p>Nos services</p>
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
					</header>

					<?php foreach ($services as $service): ?>
							<section id="banner">
								<header>
									
								</header>
								<div id="display_<?php echo htmlspecialchars($service['id_service']);?>" style="display:block;">
									<div style="margin-bottom:1em;display:flex;justify-content:space-between;align-items:center;">
										<h2 style="display:inline;margin:0;"><?php echo htmlspecialchars($service['title']); ?></h2>
										<div>
											<?php if (!empty($_SESSION) && $_SESSION['user_admin'] === 1): ?>
												<a href="#" class="button big btnUpdate" data-id="<?php echo $service['id_service']; ?>">Modifier</a>
												<a style="margin-left:2em;" href="#" class="button big btnDelete" data-id="<?php echo $service['id_service']; ?>">Supprimer</a>
											<?php endif; ?>
										</div>
									</div>
									<form id="deleteForm_<?php echo $service['id_service']; ?>" method="POST" style="display:none;">
										<input type="hidden" name="form_type" value="delete_service" />
										<input type="hidden" name="id_service" value="<?php echo $service['id_service']; ?>" />
									</form>

									<p style="color:#0099b17f;"><?php echo 'Tarif minimum <em>(plus de précision au cabinet)</em> : ' . htmlspecialchars($service['price']) . ' €'; ?></p>
									<p><?php echo nl2br(($service['content'])); ?></p>
								</div>
								
								<form id="update_<?php echo htmlspecialchars($service['id_service']);?>" style="display:none;" method='POST' action='#'>
									<div>
										<input type="hidden" name="form_type" value="update_service"/>
										<input type="hidden" name="id_service" value="<?php echo htmlspecialchars($service['id_service']); ?>"/>
										<input type="text" name="titleUpdate" value="<?php echo htmlspecialchars($service['title']); ?>"/>
										<input type="text" name="priceUpdate" value="<?php echo htmlspecialchars($service['price']); ?>"/>
										<textarea type="text" name="contentUpdate"><?php echo htmlspecialchars($service['content']); ?></textarea>
									</div>
									<input type="submit" id="btnSave_<?php echo htmlspecialchars($service['id_service']); ?>" value="Enregistrer" style="display:inline;"/>
									<a href="#" id="cancel_<?php echo htmlspecialchars($service['id_service']); ?>">Annuler</a>
								</form>
							</section>

							<script>
								document.addEventListener("DOMContentLoaded", function() {
									let updateBtn = document.querySelector('.btnUpdate[data-id="<?php echo $service['id_service']; ?>"]');
									let cancelBtn = document.getElementById('cancel_<?php echo htmlspecialchars($service['id_service']); ?>');
									let saveBtn = document.getElementById('btnSave_<?php echo htmlspecialchars($service['id_service']); ?>');
									let currentForm = null;
									
									updateBtn.onclick = function(event) {
										event.preventDefault();
										
										// Afficher les champs de modification
										document.getElementById('display_<?php echo htmlspecialchars($service['id_service']);?>').style.display = 'none';
										document.getElementById('update_<?php echo htmlspecialchars($service['id_service']);?>').style.display = 'block';

										// Afficher le bouton Sauvegarder
										document.getElementById('save_<?php echo $service['id_service']; ?>').style.display = 'block';
									};
									cancelBtn.onclick = function() {
										
										// Afficher les champs de modification
										document.getElementById('display_<?php echo htmlspecialchars($service['id_service']);?>').style.display = 'block';
										document.getElementById('update_<?php echo htmlspecialchars($service['id_service']);?>').style.display = 'none';

										// Afficher le bouton Sauvegarder
										document.getElementById('save_<?php echo $service['id_service']; ?>').style.display = 'none';
									};
								});
							</script>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Sidebar -->
			<div id="sidebar">
				<div class="inner">

					<?php if (!empty($_SESSION)): ?>
						
						<section id="search" class="alt">
							<div class="align-center" style="display: flex; justify-content: center; gap: 2em;">
								<h2>Bonjour <em style="color: #007385;  font-style: normal;"> <?php echo $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']; ?></em></h2>
							</div>
							<a href="#" id="disconnect" class="align-center" style="display: flex; justify-content: center; border: none;">Se deconnecter</a>
						</section>
					
					<?php else: ?>
					
						<section id="search" class="alt">
							<div class="align-center" style="display: flex; justify-content: center; gap: 2em;">
								<a href="login" style="border: none;">Se connecter</a>
								<a href="register" style="border: none;">S'enregistrer</a>
							</div>
						</section>
					
					<?php endif; ?>

					<!-- Menu -->
					<nav id="menu">
						<?php if ((!empty($_SESSION)) && $_SESSION['user_admin'] === 1): ?>
							<ul>
								<li><a href="dashboard" style="font-weight:700; font-size:1.5em; border-bottom:solid 1px rgba(210, 215, 217, 0.75); margin-bottom:1em; padding-top:0;">Dashboard</a></li>
							</ul>
						<?php endif; ?>
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
		<!-- Script TinyMCE -->
		<script>
				tinymce.init({
					selector: 'textarea',
					menubar: '',
					toolbar: 'undo redo | bold italic underline | link | a11ycheck typography | numlist bullist indent outdent | emoticons charmap | removeformat',
					tinycomments_author: 'Author name',
					width: '100%',
				});
			</script>

		<!-- Modale de déconnexion -->
		<div id="logoutModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span class="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Déconnexion</h2>
				<p>Souhaitez vous vraiment vous déconnecter ?</p>
				<div class="align-center">
					<a href="logout" id="destroyModal" class="button big">Oui</a>
					<a href="" class="closeModal" style="margin-left:1.5em;">Annuler</a>
				</div>
			</div>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.getElementById('disconnect').onclick = function(event) {
					event.preventDefault()
					document.getElementById('logoutModal').style.display = 'flex'; 
				}; 
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				const closeButtons = document.querySelectorAll('.closeModal');
    			closeButtons.forEach(function(button) {
        			button.onclick = function() {
            			document.getElementById('logoutModal').style.display = 'none'; 
        			};
    			});
			});
			document.addEventListener("DOMContentLoaded", function() {
    			document.getElementById('destroyModal').onclick = function() {
					document.getElementById('logoutModal').style.display = 'none'; 
				}; 
			});
		</script>

		<!-- Modale confirmation de modifications -->
		<div id="updateServiceModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span class="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Modifications utilisateur</h2>
				<p>Souhaitez vous vraiment modifier ce service ?</p>
				<div class="align-center">
					<button id="confirmUpdate" class="button big">Oui</button>
					<a href="" class="closeModal" style="margin-left:1.5em;">Annuler</a>
				</div>
			</div>
		</div>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
				let saveButtons = document.querySelectorAll('input[id^="btnSave_"]');
				let currentForm = null;

				saveButtons.forEach(function(button) {
					button.onclick = function(event) {
						event.preventDefault(); // Empêcher la soumission directe du formulaire
						currentForm = this.closest('form'); // Récupérer le formulaire courant
						document.getElementById('updateServiceModal').style.display = 'flex'; // Ouvrir la modale
					};
				});
				document.getElementById('confirmUpdate').onclick = function() {
					if (currentForm) {
						currentForm.submit(); // Soumettre le formulaire si confirmation
					}
					document.getElementById('updateServiceModal').style.display = 'none'; // Fermer la modale
				};
				const closeButtons = document.querySelectorAll('.closeModal');
				closeButtons.forEach(function(button) {
					button.onclick = function() {
						document.getElementById('updateServiceModal').style.display = 'none'; // Fermer la modale
					};
				});
			});
		</script>

		<!-- Modale pour supprimer un service -->
		<div id="deleteServiceModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span class="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Suppression de service</h2>
				<p>Souhaitez vous vraiment supprimer ce service ?</p>
				<div class="align-center">
					<button id="confirmDelete" class="button big">Oui</button>
					<a href="" class="closeModal" style="margin-left:1.5em;">Annuler</a>
				</div>
			</div>
		</div>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
				const updateButtons = document.querySelectorAll('.btnDelete');
				let currentForm = null;

				updateButtons.forEach(function(button) {
					button.onclick = function(event) {
						event.preventDefault();
						const serviceId = this.getAttribute('data-id');
            			currentForm = document.getElementById('deleteForm_' + serviceId);
						document.getElementById('deleteServiceModal').style.display = 'flex';
					};
				});
				document.getElementById('confirmDelete').onclick = function() {
					if (currentForm) {
						currentForm.submit(); 
					}
					document.getElementById('deleteServiceModal').style.display = 'none'; 
				};
				const closeButtons = document.querySelectorAll('.closeModal');
				closeButtons.forEach(function(button) {
					button.onclick = function() {
						document.getElementById('deleteServiceModal').style.display = 'none'; 
					};
				});
			});
		</script>
	</body>
</html>