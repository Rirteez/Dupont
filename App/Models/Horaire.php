<?php
namespace App\Models;

use PDO;

class Horaire {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM horaire');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM horaire WHERE jour = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($jour, $Hdebutam, $Hfinam, $Hdebutpm, $Hfinpm) {
        $stmt = $this->pdo->prepare('UPDATE horaire SET H_debut_am = ?, H_fin_am = ?, H_debut_pm = ?, H_fin_pm = ? WHERE jour = ?');
        return $stmt->execute([$Hdebutam, $Hfinam, $Hdebutpm, $Hfinpm, $jour]);
    }
}
?>