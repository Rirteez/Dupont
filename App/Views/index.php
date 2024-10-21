<!DOCTYPE HTML>


<html>
	<head>
		<title>Dr Dupont - Accueil</title>
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
						<p>Dr. Dupont</p>
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="content">
							<header>
								<h1>Bonjour, je suis le<br />
								Docteur Dupont</h1>
								<p>Bienvenue dans mon cabinet dentiste</p>
							</header>
							<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Dapibus volutpat hendrerit amet maximus consectetur montes. Litora ipsum donec per risus molestie metus? Nostra porttitor venenatis magna et ad vitae. Ante euismod tortor faucibus tellus orci vitae pellentesque. Hendrerit nisl mattis aenean magna sit non tempor.</p>
							<ul class="actions">
								<li><a href="rendezvous" class="button big">Prenez rendez-vous dès maintenant</a></li>
							</ul>
						</div>
						<span class="image object">
							<img src="images/pic10.jpg" alt="" />
						</span>
					</section>

					<section id="banner">
						<span class="image object">
							<img src="images/cabinet.jpg" alt="" />
						</span>
						<div class="content">
							<header>
								<h1>Le cabinet</h1>
							</header>
							<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Dui iaculis proin integer sodales auctor. Bibendum duis dictumst himenaeos augue cubilia bibendum elit. Gravida etiam eget mi a dis. Cubilia scelerisque ex aliquet netus mollis ut sed erat natoque. Turpis faucibus ullamcorper odio placerat placerat quam in. Rhoncus arcu commodo donec magnis litora suspendisse cras. Curae sed aliquet senectus magna et sed leo.</p>
							
							<p>Sapien feugiat maecenas lacinia, id vitae arcu proin. Vel luctus commodo praesent congue nisl curabitur. Porta consequat nisi iaculis tempus quis nibh. Nostra feugiat vel ante velit pulvinar eget magnis volutpat montes. In viverra tortor vestibulum; sodales augue torquent purus maecenas. Turpis litora ut non massa dignissim molestie mollis. Placerat fringilla integer nec felis urna lobortis habitasse habitasse. Bibendum sodales aptent rhoncus metus ex orci est et. Tempus vulputate amet senectus tempus; turpis turpis eleifend.</p>
							<ul class="actions">
								<li><a href="about" class="button big">En savoir plus sur le cabinet</a></li>
							</ul>
						</div>									
					</section>

				<!-- Section -->
					<section>
						<header class="major">
							<h2>Nos services</h2>
						</header>
						<div class="features">
							<article>
								<span class="icon solid fa-teeth-open"></span>
								<div class="content">
									<h3>Dentisterie générale</h3>
									<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
								</div>
							</article>
							<article>
								<span class="icon solid fa-tooth"></span>
								<div class="content">
									<h3>Chirurgie dentaire</h3>
									<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
								</div>
							</article>
							<article>
								<span class="icon solid fa-stethoscope"></span>
								<div class="content">
									<h3>Orthodontie</h3>
									<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
								</div>
							</article>
							<article>
								<span class="icon solid fa-grin-beam"></span>
								<div class="content">
									<h3>Denturologie</h3>
									<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
								</div>
							</article>
							<article>
								<span class="icon solid fa-star"></span>
								<div class="content">
									<h3>Esthétique dentaire</h3>
									<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Dapibus volutpat hendrerit amet maximus consectetur montes. </p>
								</div>
							</article>
							<article>
								<span class="icon solid fa-x-ray"></span>
								<div class="content">
									<h3>Radiologie dentaire</h3>
									<p>Litora ipsum donec per risus molestie metus? Nostra porttitor venenatis magna et ad vitae. Ante euismod tortor faucibus tellus orci vitae pellentesque. Hendrerit nisl mattis aenean magna sit non tempor.</p>
								</div>
							</article>
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

		<!-- Modale pour afficher les erreurs -->
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