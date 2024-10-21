<?php

namespace App\Controllers;
use App\Models\Actu;
use App\Models\Horaire;
use App\Models\Service;
use App\Models\User;
use App\Models\Rendezvous;
use PDO;

class FrontController {
    private $actu;
    private $service;
    private $horaire;
    private $user;
    private $rendezvous;

    public function __construct() {
        global $pdo;
        $this->actu = new Actu($pdo);
        $this->horaire = new Horaire($pdo);
        $this->service = new Service($pdo);
        $this->user = new User($pdo);
        $this->rendezvous = new Rendezvous($pdo);
    }

    public function logout() {
        session_destroy();
        header("Location: /");
        exit;
    }

    public function index() {
        $horaires = $this->horaire->getAll();
        require_once '../App/Views/index.php';
    }

    public function rendezvousAdmin() {
        $horaires = $this->horaire->getAll();
        $services = $this->service->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['form_type'])) {
                switch ($_POST['form_type']) {
                    case 'interact_rdv':
                        $id_rdv = $_POST['id_rdv_update']; 
                        $date = $_POST['date_rdv_update'];
                        $heure = $_POST['heure_rdv_update'];
                        $id_user = $_POST['user_rdv_update'];
                        $id_service = $_POST['service_rdv_update'];
                        $rdvs = $this->rendezvous->update($id_rdv, $date, $heure, $id_user, $id_service);
                        header('Location: /rendezvousAdmin');
                        exit; 
                        break;

                    case 'delete_rdv':
                        $id_rdv = $_POST['id_rdv_del'];  
                        $this->rendezvous->delete($id_rdv);
                        header("Location: /rendezvousAdmin"); 
                        exit; 
                        break;
                    }
            }
        }

        require_once '../App/Views/rendezvousAdmin.php';
    }

    public function rendezvous() {
        $services = $this->service->getAll();
        $horaires = $this->horaire->getAll();
        $error = '';

        if (!empty($_SESSION)) {
            if ($_SESSION['user_admin'] === 1) {
                $rdvs = $this->rendezvous->getAll();
            } else {
                $rdvs = $this->rendezvous->getByUser($_SESSION['user_id']);
            }
        }
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['form_type'])) {
                switch ($_POST['form_type']) {
                    case 'add_rdv':
                        // Variable pour tester la validité de la date du rdv
                        $today = new \DateTime();
                        $today->setTime(0, 0, 0);
                        $date_test = new \DateTime($_POST['date_rdv']);
                        $date_test->setTime(0, 0, 0);
                    
                        $formatter = new \IntlDateFormatter(
                            'fr_FR', // Locale pour le français
                            \IntlDateFormatter::FULL, // Type de formatage complet
                            \IntlDateFormatter::NONE, // Pas besoin d'afficher l'heure
                            null, // Utiliser le fuseau horaire par défaut
                            \IntlDateFormatter::GREGORIAN, // Type de calendrier
                            'EEEE' // Format pour obtenir le nom complet du jour (ex. Lundi, Mardi)
                        );
                    
                        $nomDuJour = $formatter->format($date_test);
                        
                        // Utilisation correcte de la variable $nomDuJour
                        $jourRdv = $this->horaire->getById($nomDuJour);
                    
                        // Vérifiez si $jourRdv est un tableau avant de l'utiliser
                        if ($jourRdv) {
                            // Initialisation de la variable $heure
                            $heure = null;
                    
                            // Verifie que le rdv est prit dans les horaires d'ouverture
                            if (isset($_POST['heure_rdv'])) {

                                $heureRdv = new \DateTime($_POST['heure_rdv']);
                                $debutAm = new \DateTime($jourRdv['H_debut_am']);
                                $finAm = new \DateTime($jourRdv['H_fin_am']);
                                $debutPm = new \DateTime($jourRdv['H_debut_pm']);
                                $finPm = new \DateTime($jourRdv['H_fin_pm']);

                                if (!empty($_POST['heure_rdv']) && 
                                    (($heureRdv >= $debutAm && $heureRdv <= $finAm) || ($heureRdv >= $debutPm && $heureRdv <= $finPm))) {
                                    
                                    $heure = $_POST['heure_rdv'];
                                } else {
                                    $error = "Heure invalide. Veuillez prendre rendez-vous dans les horaires d'ouverture du cabinet.";
                                }
                            }
                    
                            // Vérifie si l'heure a bien été définie
                            if ($heure !== null) {
                                $id_user = $_POST['user_rdv'];
                                $id_service = $_POST['service_rdv'];
                    
                                // Verifie que le rdv est prit dans le futur 
                                if ($date_test == $today) {
                                    $error = "Pour les urgences, veuillez nous appeler directement.";
                                } else if ($date_test < $today) {
                                    $error = "Date invalide. Veuillez prendre rendez-vous dans le futur uniquement.";
                                } else {
                                    $date = $_POST['date_rdv'];
                                    $rdvs = $this->rendezvous->create($date, $heure, $id_user, $id_service);
                                    header('Location: /rendezvous');
                                    exit; 
                                }
                            }
                        } else {
                            $error = "Aucun horaire trouvé pour le jour $nomDuJour.";
                        }
                        break;
                    
                    case 'update_rdv':
                        $id_rdv = $_POST['id_rdv'];
                        $date = $_POST['date_rdv_update'];
                        $heure = $_POST['heure_rdv_update'];
                        $id_user = $_POST['user_rdv_update'];
                        $id_service = $_POST['service_rdv_update'];
                        $rdvs = $this->rendezvous->update($id_rdv, $date, $heure, $id_user, $id_service);
                        header('Location: /rendezvous');
                        exit; 
                        break;

                    case'delete_rdv':
                        $id_rdv = $_POST['id_rdv'];  
                        $this->rendezvous->delete($id_rdv);
                        header("Location: /rendezvous"); 
                        exit; 
                        break;
                }
            }
        }
        require_once '../App/Views/rendezvous.php';
    }

    public function services() {
        $horaires = $this->horaire->getAll();
        $services = $this->service->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['form_type'])) {
                switch ($_POST['form_type']) {
                    case 'update_service':
                        $id_service = $_POST['id_service'];
                        $title = $_POST['titleUpdate'];
                        $content = $_POST['contentUpdate'];
                        $price = $_POST['priceUpdate'];
                        $this->service->update($id_service, $title, $content, $price);
                        header("Location: /services");
                        exit;
                        break;
                    
                    case 'delete_service':
                        $id_service = $_POST['id_service'];  
                        $this->service->delete($id_service);
                        header("Location: /services"); 
                        exit; 
                        break;
                }
            }
        }
        require_once '../App/Views/services.php';
    }

    public function about() {
        $horaires = $this->horaire->getAll();
        require_once '../App/Views/about.php';
    }

    public function actus() {
        $horaires = $this->horaire->getAll();
        $actus = $this->actu->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['form_type'])) {
                switch ($_POST['form_type']) {
                    case 'update_actu':
                        $id_actu = $_POST['id_actu'];
                        $title = $_POST['titleUpdate'];
                        $content = $_POST['contentUpdate'];

                        $currentActu = $this->actu->getById($id_actu);
                        $currentImgPath = $currentActu['image_actu'];

                        $newImagePath = $this->uploadImage();

                        $imagePath = $newImagePath ? $newImagePath : $currentImgPath;

                        $this->actu->update($id_actu, $title, $content, $imagePath);
                        header("Location: /actus");
                        exit;
                        break;
                    
                    case 'delete_actu':
                        $id_actu = $_POST['id_actu'];  
                        $this->actu->delete($id_actu);
                        header("Location: /actus");
                        exit;  
                        break;
                }
            }
        }
        require_once '../App/Views/actus.php';
    }

    public function dashboard() {
        $horaires = $this->horaire->getAll();
        $users = $this->user->getAll();
        $services = $this->service->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['form_type'])) {
                switch ($_POST['form_type']) {
                    case 'update_user':
                        $id_user = $_POST['user_id'];
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $admin = isset($_POST['admin']) && $_POST['admin'] === 'on' ? 1 : 0;
                        $ddn = $_POST['ddn'];
                        $genre = $_POST['genre'];
                        $mail = $_POST['mail'];
                        $this->user->update($id_user, $nom, $prenom, $admin, $ddn, $genre, $mail);
                        header("Location: /dashboard");
                        break;
                    
                    case 'delete_user':
                        $id_user = $_POST['user_id'];  
                        $this->user->delete($id_user);
                        header("Location: /dashboard");  
                        break;
                    
                    case 'new_service':
                        $title = $_POST['titreService'];
                        $price = $_POST['tarif'];
                        $content = $_POST['contenuService'];
                        $services = $this->service->create($title, $content, $price);
                        break;

                    case 'new_actu':
                        $title = $_POST['titreActu'];
                        $content = $_POST['contenuActu'];
                        $datecreate = new \DateTime();
                        $date = $datecreate->format('Y-m-d');
                        $imagePath = $this->uploadImage();
                        $actus = $this->actu->create($title, $content, $imagePath, $date);
                        break;
                    
                    case 'horaire_update':
                        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

                        foreach ($jours as $jour) {
                            
                            $Hdebutam = !empty($_POST[$jour . '_HDAM']) ? $_POST[$jour . '_HDAM'] : null;
                            $Hfinam = !empty($_POST[$jour . '_HFAM']) ? $_POST[$jour . '_HFAM'] : null;
                            $Hdebutpm = !empty($_POST[$jour . '_HDPM']) ? $_POST[$jour . '_HDPM'] : null;
                            $Hfinpm = !empty($_POST[$jour . '_HFPM']) ? $_POST[$jour . '_HFPM'] : null;
                    
                            $this->horaire->update($jour, $Hdebutam, $Hfinam, $Hdebutpm, $Hfinpm);
                        }
                        header("Location: /dashboard"); 
                        exit;
                        break;
                }
            }
        }
        require_once '../App/Views/dashboard.php';
    }

    public function login() {
        $horaires = $this->horaire->getAll();
        $error = ''; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);

            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $error = "L'adresse mail n'est pas valide.";
            } else {
                $users = $this->user->getUserByMail($mail);
                if($users){
                    if (password_verify($_POST['mdp'], $users['mdp'])) {
                        session_start();
                        $_SESSION['user_id'] = $users['id_user'];
                        $_SESSION['user_prenom'] = $users['prenom'];
                        $_SESSION['user_nom'] = $users['nom'];
                        $_SESSION['user_mail'] = $users['mail'];
                        $_SESSION['user_genre'] = $users['genre'];
                        $_SESSION['user_admin'] = $users['admin'];
                        header("Location: /");
                        exit;
                    } else {
                        $error = "Mot de passe incorrect.";
                    }
                } else {
                    $error = "Votre mail n'est pas enregistré dans notre cabinet.";
                }
            }
        }
        require_once '../App/Views/login.php';
    }

    public function register() {
        $horaires = $this->horaire->getAll();
        $error = ''; 
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars($_POST['nom']); 
            $prenom = htmlspecialchars($_POST['prenom']);
            $ddn = $_POST['date_naissance'];
            $genre = $_POST['genre'];
    
            // Assainir et valider l'email
            $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $error = "L'adresse mail n'est pas valide.";
            }
    
            // Vérifier la correspondance des mots de passe
            if ($_POST['mdp1'] === $_POST['mdp2']) {
                $mdp = password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
                if (empty($error)) { 
                    $users = $this->user->create($nom, $prenom, $ddn, $genre, $mail, $mdp);
                    if ($users) {
                        header("Location: /");
                        exit;
                    } else {
                        $error = "Erreur lors de l'enregistrement. Veuillez réessayer.";
                    } 
                }
            } else {
                if (empty($error)) {
                    $error = "Les mots de passe ne correspondent pas.";
                } else {
                    $error = "L'adresse mail n'est pas valide et les mots de passe ne correspondent pas.";
                }
            }
        } 
        require_once '../App/Views/register.php';
    }

    private function uploadImage() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $fileName = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                return $fileName;
            }
        }
        return null;
    }
}

?>