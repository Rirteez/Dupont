
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dr Dupont - Rendez vous</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<p>Vos rendez vous</p>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>

								<section class="row">
									<div id="calendar" class="col-7" style="padding:0 1em;"></div>
								
									<div id="eventInteract" class="content col-5 align-center">
										<div class="get_rdv_admin">
											<h2 class="align-center" style="margin-bottom: 1.5em;">Modifier ou supprimer le rendez-vous</h2>
											<form method='POST' action='#' style="margin:0;">
												<input type=hidden name=form_type value="interact_rdv" />
												<input type=hidden name=id_rdv_update />
												<h3 id="idpatient" style="color:#0099B1"></h3>
												<input type=date name=date_rdv_update />
												<input type=time name=heure_rdv_update />
												<input type=hidden name=user_rdv_update />
												<select name="service_rdv_update">
													<?php foreach ($services as $service): ?>
														<option value="<?php echo htmlspecialchars($service['id_service']); ?>">
															<?php echo htmlspecialchars($service['title']); ?>
														</option>
													<?php endforeach; ?>
												</select>
												<input type=submit class="btnSave" value="Modifier le rendez-vous" style="margin-top:2em;"/>
												<input type=submit class="btnDelete" value="Supprimer le rendez-vous" style="margin-top:1em;"/>
											</form>

											<form id="deleteForm" method="POST" style="display:none;">
												<input type="hidden" name="form_type" value="delete_rdv" />
												<input type="hidden" name="id_rdv_del" />
											</form>
										</div>
									</div>
								</section>

								



								
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
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
		<script src="js/calendar.js"></script>

		<!-- Modale confirmation de modifications -->
			<div id="updateRdvModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
				<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
					<span class="closeModal3" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
					<h2 style="color: #007385;">Modifications du rendez-vous</h2>
					<p>Souhaitez vous vraiment modifier ce rendez-vous ?</p>
					<div class="align-center">
						<button id="confirmUpdate" class="button big">Oui</button>
						<a href="" class="closeModal3" style="margin-left:1.5em;">Annuler</a>
					</div>
				</div>
			</div>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					let currentForm = null;

					document.querySelectorAll('.btnSave').forEach(function(button) {
						button.addEventListener('click', function(event) {
							event.preventDefault(); 
							currentForm = this.closest('form'); 
							document.getElementById('updateRdvModal').style.display = 'flex'; 
						});
					});

					document.getElementById('confirmUpdate').onclick = function() {
						if (currentForm) {
							currentForm.submit();
						}
						document.getElementById('updateRdvModal').style.display = 'none'; 
					};
					const closeButtons = document.querySelectorAll('.closeModal3');
					closeButtons.forEach(function(button) {
						button.onclick = function() {
							document.getElementById('updateRdvModal').style.display = 'none'; 
						};
					});
				});
			</script>

		<!-- Modale pour supprimer un rdv -->
			<div id="deleteRdvModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
				<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
					<span class="closeModal2" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
					<h2 style="color: #007385;">Suppression du rendez-vous</h2>
					<p>Souhaitez vous vraiment annuler ce rendez-vous ?</p>
					<div class="align-center">
						<button id="confirmDelete" class="button big">Oui</button>
						<a href="" class="closeModal2" style="margin-left:1.5em;">Non</a>
					</div>
				</div>
			</div>

			<script>
				document.addEventListener("DOMContentLoaded", function() {
					const updateButtons = document.querySelectorAll('.btnDelete');
					let currentForm = document.getElementById('deleteForm'); // Corrigé pour cibler le formulaire de suppression

					updateButtons.forEach(function(button) {
						button.onclick = function(event) {
							event.preventDefault();
							const id_rdv = document.querySelector('input[name=id_rdv_update]').value; // Obtenez l'ID du rendez-vous
							currentForm.querySelector('input[name=id_rdv_del]').value = id_rdv; // Définissez la valeur dans le formulaire de suppression
							document.getElementById('deleteRdvModal').style.display = 'flex';
						};
					});

					document.getElementById('confirmDelete').onclick = function() {
						if (currentForm) {
							currentForm.submit(); 
						}
						document.getElementById('deleteRdvModal').style.display = 'none'; 
					};

					const closeButtons = document.querySelectorAll('.closeModal2');
					closeButtons.forEach(function(button) {
						button.onclick = function() {
							document.getElementById('deleteRdvModal').style.display = 'none'; 
						};
					});
				})
			</script>

		<!-- Modale de deconnexion -->
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
	</body>
</html>