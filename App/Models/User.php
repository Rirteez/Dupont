<?php
namespace App\Models;

use PDO;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM utilisateur ORDER BY admin DESC, nom, prenom');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE id_user = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByMail($mail) {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE mail = ?');
        $stmt->execute([$mail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $prenom, $ddn, $genre, $mail, $mdp) {
        $stmt = $this->pdo->prepare('INSERT INTO utilisateur (nom, prenom, ddn, genre, mail, mdp) VALUES (?, ?, ?, ?, ?, ?)');
        return $stmt->execute([$nom, $prenom, $ddn, $genre, $mail, $mdp]);
    }

    public function update($id, $nom, $prenom, $admin, $ddn, $genre, $mail) {
        $stmt = $this->pdo->prepare('UPDATE utilisateur SET nom = ?, prenom = ?, admin = ?, ddn = ?, genre = ?, mail = ? WHERE id_user = ?');
        return $stmt->execute([$nom, $prenom, $admin, $ddn, $genre, $mail, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM utilisateur WHERE id_user = ?');
        return $stmt->execute([$id]);
    }
}
?>