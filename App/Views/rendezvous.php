<!DOCTYPE HTML>
<html>
	<head>
		<title>Dr Dupont - Rendez vous</title>
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
									<p>Vos rendez vous</p>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									</ul>
								</header>

							<section id="banner">
								<?php if(!empty($_SESSION)): ?>

									<div class="content">

										<?php foreach ($rdvs as $rdv): ?>
											<form id="deleteForm_<?php echo $rdv['id_rdv']; ?>" method="POST" style="display:none;">
												<input type="hidden" name="form_type" value="delete_rdv" />
												<input type="hidden" name="id_rdv" value="<?php echo $rdv['id_rdv']; ?>" />
											</form>

											<div id="updateRendezvous_<?php echo htmlspecialchars($rdv['id_rdv']); ?>" class="updateRdvForm" >
												<div class="update_rdv align-center">
													<h2>Modifier votre rendez-vous</h2>
													<form method='POST' action='#' style="margin:0;">
														<input type=hidden name=form_type value="update_rdv" />
														<input type=hidden name=id_rdv value="<?php echo $rdv['id_rdv']; ?>" />
														<input type=date name=date_rdv_update value="<?php echo htmlspecialchars($rdv['date']); ?>" />
														<input type=time name=heure_rdv_update value="<?php echo htmlspecialchars($rdv['heure']); ?>" />
														<input type=hidden name=user_rdv_update value="<?php echo $_SESSION['user_id']; ?>" />
														<select name="service_rdv_update">
															<?php foreach ($services as $service): ?>
																<option value="<?php echo htmlspecialchars($service['id_service']); ?>" <?php echo $rdv['id_service'] == $service['id_service'] ? 'selected' : ''; ?>>
																	<?php echo htmlspecialchars($service['title']); ?>
																</option>
															<?php endforeach; ?>
														</select>
														<input type=submit class="btnSave" value="Modifier le rendez-vous" style="margin-top:2em;"/>
													</form>
												</div>
											</div>
										<?php endforeach; ?>

										<div>
											<div class="set_rdv align-center">
												<h2>Prendre un nouveau rendez-vous</h2>
												<form method='POST' action='#' style="margin:0;">
													<input type=date name=date_rdv /> 
													<input type=time name=heure_rdv />
													<input type=hidden name=form_type value="add_rdv" />
													<input type=hidden name=user_rdv value="<?php echo $_SESSION['user_id']; ?>" />
													<select name="service_rdv">
														<option value=""></option>
														<?php foreach ($services as $service): ?>
															<option value="<?php echo htmlspecialchars($service['id_service']); ?>"><?php echo htmlspecialchars($service['title']); ?></option>
														<?php endforeach; ?>
													</select>
													<input type=submit name="valider_rdv" value="Valider le rendez-vous" style="margin-top:2em;"/>
												</form>
											</div>
										</div>
									</div>

									<span class="content">
										<div class="get_rdv align-center">
											<h2>Vos rendez-vous à venir</h2>
											<ul style="list-style-type: none; padding:0;">
												<?php foreach ($rdvs as $rdv): ?>
													<?php 
														$service = $this->service->getById($rdv['id_service']);
														$date = new DateTime($rdv['date']);
														$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
														$date_fr = $formatter->format($date);
													?>
													<div class="row rendezvous align-left">
														<div class="col-7">
															<li>
																<p>Le, <em style="color:#0099b1; font-style:normal;"><?php echo htmlspecialchars(mb_convert_case($date_fr, MB_CASE_TITLE, "UTF-8")); ?></em></p>
																<p>à, <em style="color:#007385; font-style:normal;"><?php echo htmlspecialchars(substr($rdv['heure'], 0, 5)); ?></em></p>
																<p>pour, <em style="color:#0099b1; font-style:normal;"><?php echo htmlspecialchars($service['title']); ?></em></p>
															</li>
														</div>
														<div class="col-5 btn_getRdv">
															<a href="#" class="button btnUpdate" data-id="<?php echo $rdv['id_rdv']; ?>">Modifier</a>
															<a href="#" class="button btn_Cancel" data-id="<?php echo $rdv['id_rdv']; ?>" style="display:none; color:#e2a89f; box-shadow:inset 0 0 0 2px #e2a89f;">Annuler</a>
															<a href="#" class="button btnDelete" data-id="<?php echo $rdv['id_rdv']; ?>">Supprimer</a>
														</div>
													</div>
												<?php endforeach; ?>
											</ul>
										</div>
									</span>

									<script>
										document.addEventListener("DOMContentLoaded", function() {

											document.querySelectorAll('.btnUpdate').forEach(function(button) {
												button.addEventListener('click', function(event) {
													event.preventDefault();
													let rdv_id = button.getAttribute('data-id');

													// Cacher tous les formulaires
													document.querySelectorAll('.updateRdvForm').forEach(function(form) {
														form.style.maxHeight = '0';
             									    	form.classList.remove('show');
													});

													// Afficher le formulaire concerné
													let updateRdv = document.getElementById('updateRendezvous_' + rdv_id);
													updateRdv.classList.add('show'); 
                									updateRdv.style.maxHeight = updateRdv.scrollHeight + 'px';	

													// Cacher le bouton annuler et réafficher le bouton modifier si un formulaire de modification était deja ouvert
													document.querySelectorAll('.btn_Cancel').forEach(function(cancelButton) {
														cancelButton.style.display = 'none';
													});
													document.querySelectorAll('.btnUpdate').forEach(function(updateButton) {
														updateButton.style.display = 'block';
													});

													// Afficher bouton annuler à la place du modifier
													button.style.display = 'none';
													document.querySelector('.btn_Cancel[data-id="' + rdv_id + '"]').style.display = 'block';
												});
											});

											document.querySelectorAll('.btn_Cancel').forEach(function(button) {
												button.addEventListener('click', function(event) {
													event.preventDefault();
													let rdv_id = button.getAttribute('data-id');

													// Cacher le formulaire concerné
													let updateRdv = document.getElementById('updateRendezvous_' + rdv_id);
													updateRdv.style.maxHeight = '0'; 
                									updateRdv.classList.remove('show');

													// Afficher bouton modifier à la place du annuler
													button.style.display = 'none'; 
													let updatebutton = document.querySelector('.btnUpdate[data-id="' + rdv_id + '"]'); 
													updatebutton.style.display = 'block';
												});
											});
										});
									</script>


								<?php else: ?>
									<h2 style="color:#3d4449bf;">Vous devez être connecté pour afficher la liste de vos rendez vous.</h2>
								<?php endif; ?>
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

		<!-- Modale confirmation de modifications -->
		<div id="updateRdvModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span class="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Modifications du rendez-vous</h2>
				<p>Souhaitez vous vraiment modifier ce rendez-vous ?</p>
				<div class="align-center">
					<button id="confirmUpdate" class="button big">Oui</button>
					<a href="" class="closeModal" style="margin-left:1.5em;">Annuler</a>
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
				const closeButtons = document.querySelectorAll('.closeModal');
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
				<span class="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Suppression du rendez-vous</h2>
				<p>Souhaitez vous vraiment annuler ce rendez-vous ?</p>
				<div class="align-center">
					<button id="confirmDelete" class="button big">Oui</button>
					<a href="" class="closeModal" style="margin-left:1.5em;">Non</a>
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
						const id_rdv = this.getAttribute('data-id');
            			currentForm = document.getElementById('deleteForm_' + id_rdv);
						document.getElementById('deleteRdvModal').style.display = 'flex';
					};
				});
				document.getElementById('confirmDelete').onclick = function() {
					if (currentForm) {
						currentForm.submit(); 
					}
					document.getElementById('deleteRdvModal').style.display = 'none'; 
				};
				const closeButtons = document.querySelectorAll('.closeModal');
				closeButtons.forEach(function(button) {
					button.onclick = function() {
						document.getElementById('deleteRdvModal').style.display = 'none'; 
					};
				});
			});
		</script>

		<!-- Modale deconnexion -->
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

		<!-- Modale pour afficher les erreurs -->
		<div id="errorModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
			<div style="background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; position: relative;">
				<span id="closeModal" style="cursor:pointer; position:absolute; right:10px; top:10px;">&times;</span>
				<h2 style="color: #007385;">Erreur</h2>
				<p id="errorMessage"></p>
			</div>
		</div>

		
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				<?php if (!empty($error)): ?>
					var errorMessage = "<?php echo addslashes($error); ?>";
					console.log('Erreur : " . addslashes($error) . "');
					document.getElementById('errorMessage').innerText = errorMessage;
					document.getElementById('errorModal').style.display = 'flex';
				<?php endif; ?>// Affiche la modale
			});
			
			// Fermer la modale lorsque l'utilisateur clique sur la croix
			document.getElementById('closeModal').onclick = function() {
				document.getElementById('errorModal').style.display = 'none'; // Ferme la modale
			};

			// Fermer la modale si l'utilisateur clique en dehors de la boîte de dialogue
			window.onclick = function(event) {
				if (event.target == document.getElementById('errorModal')) {
					document.getElementById('errorModal').style.display = 'none'; // Ferme la modale
				}
			};
		</script>

	</body>
</html>