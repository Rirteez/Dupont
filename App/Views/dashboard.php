<!DOCTYPE HTML>

<html>
	<head>
		<title>Dr Dupont - Actualités</title>
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
						<p>Dashboard</p>
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
					</header>
						
					<section>
						<h2>Modification des horaires du cabinet</h2>
						<form method="POST" action="#">
							<input type=hidden name="form_type" value="horaire_update" />
							<div class="row">
								<?php foreach($horaires as $horaire): ?>
									<div class="col-2">
										<h4 class="align-center"><?php echo $horaire['jour']; ?></h4>
										Heure ouverture
										<input type=time name="<?php echo $horaire['jour']; ?>_HDAM" value="<?php echo !empty($horaire['H_debut_am']) ? $horaire['H_debut_am'] : ''; ?>" />
										Heure ouverture
										<input type=time name="<?php echo $horaire['jour']; ?>_HFAM" value="<?php echo !empty($horaire['H_fin_am']) ? $horaire['H_fin_am'] : ''; ?>" />
										Heure fermeture
										<input type=time name="<?php echo $horaire['jour']; ?>_HDPM" value="<?php echo !empty($horaire['H_debut_pm']) ? $horaire['H_debut_pm'] : ''; ?>" />
										Heure fermeture
										<input type=time name="<?php echo $horaire['jour']; ?>_HFPM" value="<?php echo !empty($horaire['H_fin_pm']) ? $horaire['H_fin_pm'] : ''; ?>" />
									</div>
								<?php endforeach; ?>
							</div>
							<div class="align-right" style="margin-top:2em;"><input type=submit value="Mettre à jour" /></div>
						</form>
					</section>

					<!-- Section Affichage et modification des infos utilisateurs -->
					<section id="userData" style="padding: 3em 0 4em 0;">
						<h2>Modification ou suppression des fichiers utilisateurs</h2>
						<div id="userList" class="row">
							<?php foreach ($users as $user): ?>
								<section>
									<div class="dataDropDown" data-id="<?php echo $user['id_user'];?>">
										<a class="userMenu" href="#" style="border:none;<?php if ($user['admin'] === 1) { echo "color:#e69d92;";}; ?>" class="btnDeroulant_<?php echo $user['id_user'];?>">
											<?php echo $user['nom']; ?> <?php echo $user['prenom']; ?>
										</a>
										<i class="fas fa-chevron-down"></i>
									</div>
									<div id="userInter_<?php echo $user['id_user'];?>" class="userInteraction rows content" data-id="<?php echo $user['id_user'];?>">
										<form method="POST" action="#">
											<input type="hidden" name="form_type" value="update_user"/>
											<input type="hidden" name="user_id" value="<?php echo $user['id_user'];?>"/>
											<div class="row">
												<div class="col-6">
													<input type="text" name="nom" value="<?php echo $user['nom']; ?>"/>
													<input type="date" name="ddn" value="<?php echo $user['ddn']; ?>"/>
												</div>
												<div class="col-6">
													<input type="text" name="prenom" value="<?php echo $user['prenom']; ?>"/>
													<select name="genre">
														<option value="Homme" <?php if ($user['genre'] === 'Homme') echo 'selected'; ?>>Homme</option>
														<option value="Femme" <?php if ($user['genre'] === 'Femme') echo 'selected'; ?>>Femme</option>
													</select>
												</div>

												<div class="col-8">
													<input style="margin:0;" type="text" name="mail" value="<?php echo $user['mail']; ?>"/>
												</div>

												<div class="col-4" style="display:flex;justify-content:center;align-items:center;">
													<input style="padding:0;margin:0;" type="checkbox" id="admin" name="admin" <?php if ($user['admin'] === 1) { echo "checked";}; ?>></input>
													<p style="padding:0;margin:0;margin-left:1em;">Administrateur</p>
												</div>
											</div>
											<div class="align-center" style="margin:2em 0;display:flex;justify-content:space-evenly;">
												<input class="update" type="submit" value="Modifier">
												<input class="delete" type="submit" value="Supprimer">
											</div>
										</form>
									</div>
								</section>
							<?php endforeach; ?>
						</div>
					</section>
					<script>
						document.addEventListener("DOMContentLoaded", function() {
							document.querySelectorAll('.dataDropDown').forEach(function(dropdown) {
								dropdown.addEventListener('click', function(event) {
									event.preventDefault();
									let dropdown_id = dropdown.getAttribute('data-id');

									let dropdownShow = document.getElementById('userInter_' + dropdown_id);
									
									if (dropdownShow.classList.contains('show')) {
										dropdownShow.style.maxHeight = '0';
										dropdownShow.classList.remove('show');
									} else {
										document.querySelectorAll('.userInteraction').forEach(function(form) {
											form.style.maxHeight = '0';
											form.classList.remove('show');
										});
										dropdownShow.classList.add('show');
										dropdownShow.style.maxHeight = dropdownShow.scrollHeight + 'px';
									}
								});
							});
						});
					</script>

					<!-- Section création d'un nouveau service -->
					<section id="banner" class="newContent">
						<form method="POST" action="#" style="width:100%;">
							<input type="hidden" name="form_type" value="new_service"/>
							<h2>Ajouter un service</h2>
							<input type=text name="titreService" placeholder="Titre du service"></input>
							<input type=text name="tarif" placeholder="Tarif du service"></input>
							<textarea type=text name="contenuService" placeholder="Détails du service"></textarea>
							<div class="align-right"><input class="send" type="submit" value="Ajouter"></div>
						</form>
					</section>

					<!-- Section création d'une nouvelle actualité -->
					<section id="banner" class="newContent">
						<form method="POST" action="#" style="width:100%;" enctype="multipart/form-data">
							<input type="hidden" name="form_type" value="new_actu"/>
							<h2>Ajouter un article</h2>
							<input type=text name="titreActu" placeholder="Titre de l'actualité"></input>
							<textarea name="contenuActu" placeholder="Contenu de l'article"></textarea>
							<input type="file" name="image" id="imageActu" accept="image/*">
							<div class="align-right"><input class="send" type="submit" value="Publier"></div>
						</form>
					</section>
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


					<!-- Section horaire -->
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
							<li class="icon solid fa-home">123 rue Sans nom<br />Toulouse, 31400</li>
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
		<!-- ------------------------------------- -->
		<!-- Modale de deconnexion -->
			<div id="logoutModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
				<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
					<span class="closeModal3" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
					<h2 style="color: #007385;">Déconnexion</h2>
					<p>Souhaitez vous vraiment vous déconnecter ?</p>
					<div class="align-center">
						<a href="logout" id="confirmLogout" class="button big">Oui</a>
						<a href="" class="closeModal3" style="margin-left:1.5em;">Annuler</a>
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
					const closeButtons = document.querySelectorAll('.closeModal3');
					closeButtons.forEach(function(button) {
						button.onclick = function() {
							document.getElementById('logoutModal').style.display = 'none'; 
						};
					});
				});
				document.addEventListener("DOMContentLoaded", function() {
					document.getElementById('confirmLogout').onclick = function() {
						document.getElementById('logoutModal').style.display = 'none'; 
					}; 
				});
			</script>
		
		<!-- ------------------------------------- -->
		<!-- Modale pour modifier un utilisateur -->
			<div id="updateUserModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
				<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
					<span class="closeModal2" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
					<h2 style="color: #007385;">Modifications utilisateur</h2>
					<p>Souhaitez vous vraiment modifier cet utilisateur ?</p>
					<div class="align-center">
						<button id="confirmUpdate" class="button big">Oui</button>
						<a href="" class="closeModal" style="margin-left:1.5em;">Annuler</a>
					</div>
				</div>
			</div>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					const updateButtons = document.querySelectorAll('.update');
					let currentForm = null;

					updateButtons.forEach(function(button) {
						button.onclick = function(event) {
							event.preventDefault();
							currentForm = this.closest('form');
							document.getElementById('updateUserModal').style.display = 'flex';
						};
					});
					document.getElementById('confirmUpdate').onclick = function() {
						if (currentForm) {
							currentForm.submit(); 
						}
						document.getElementById('updateUserModal').style.display = 'none'; 
					};
					const closeButtons = document.querySelectorAll('.closeModal2');
					closeButtons.forEach(function(button) {
						button.onclick = function() {
							document.getElementById('updateUserModal').style.display = 'none'; 
						};
					});
				});
			</script>
		<!-- ------------------------------------- -->
		<!-- Modale pour supprimer un utilisateur -->
			<div id="deleteUserModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
				<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
					<span class="closeModal2" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
					<h2 style="color: #007385;">suppression utilisateur</h2>
					<p>Souhaitez vous vraiment supprimer cet utilisateur ?</p>
					<div class="align-center">
						<button id="confirmDelete" class="button big">Oui</button>
						<a href="" class="closeModal2" style="margin-left:1.5em;">Annuler</a>
					</div>
				</div>
			</div>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					const updateButtons = document.querySelectorAll('.delete');
					let currentForm = null;

					updateButtons.forEach(function(button) {
						button.onclick = function(event) {
							event.preventDefault();
							currentForm = this.closest('form');
							document.getElementById('deleteUserModal').style.display = 'flex';
						};
					});
					document.getElementById('confirmDelete').onclick = function() {
						if (currentForm) {
							currentForm.querySelector('input[name="form_type"]').value='delete_user';
							currentForm.submit(); 
						}
						document.getElementById('deleteUserModal').style.display = 'none'; 
					};
					const closeButtons = document.querySelectorAll('.closeModal2');
					closeButtons.forEach(function(button) {
						button.onclick = function() {
							document.getElementById('deleteUserModal').style.display = 'none'; 
						};
					});
				});
			</script>
	</body>
</html>