<?php
namespace App\Models;

use PDO;

class Rendezvous {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM rendezvous ORDER BY date, heure');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($id_user) {
        $stmt = $this->pdo->prepare('SELECT * FROM rendezvous WHERE id_utilisateur = ? ORDER BY date, heure');
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM rendezvous WHERE id_rdv = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($date, $heure, $id_user, $id_service) {
        $stmt = $this->pdo->prepare('INSERT INTO rendezvous (date, heure, id_utilisateur, id_service) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$date, $heure, $id_user, $id_service]);
    }

    public function update($id, $date, $heure, $id_user, $id_service) {
        $stmt = $this->pdo->prepare('UPDATE rendezvous SET date = ?, heure = ?, id_utilisateur = ?, id_service = ? WHERE id_rdv = ?');
        return $stmt->execute([$date, $heure, $id_user, $id_service, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM rendezvous WHERE id_rdv = ?');
        return $stmt->execute([$id]);
    }
}
?>