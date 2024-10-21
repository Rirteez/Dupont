<?php
use App\Models\Service;
use App\Models\User;
use App\Models\Rendezvous;

require_once '../../App/config/config.php';
require_once '../../App/Models/Service.php';
require_once '../../App/Models/User.php';
require_once '../../App/Models/Rendezvous.php';

$userModel = new User($pdo);
$serviceModel = new Service($pdo);
$rendezvousModel = new Rendezvous($pdo);

header('Content-Type: application/json');

try {
    // Récupérer tous les rendez-vous
    $rdvs = $rendezvousModel->getAll();

    $events = array_map(function($rdv) use ($userModel, $serviceModel) {
        $user = $userModel->getById($rdv['id_utilisateur']);
        $service = $serviceModel->getById($rdv['id_service']);


        $dateTimeString = $rdv['date'] . ' ' . $rdv['heure'];
        $start = new DateTime($dateTimeString);
        $end = clone $start;
        $end->modify('+1 hour');

        // Formater les dates pour FullCalendar
        $startFormatted = $start->format('Y-m-d\TH:i:s');
        $endFormatted = $end->format('Y-m-d\TH:i:s');

        return [
            // titre de l'objet
            'title' => $user['nom'] . ' ' . $user['prenom'],
            // tous les paramètres de la table rendezvous
            'id' => $rdv['id_rdv'],
            'start' => $startFormatted,
            'end' => $endFormatted,
            'id_user' => $rdv['id_utilisateur'],
            'id_service' => $service['id_service'],
            'description' => $service['title']
        ];
    }, $rdvs);

    // Convertir en JSON
    echo json_encode($events);
    exit;
    
} catch (Exception $e) {
    // En cas d'erreur, renvoyer un message d'erreur en JSON
    echo json_encode(['error' => 'Erreur lors de la récupération des données : ' . $e->getMessage()]);
}
?>