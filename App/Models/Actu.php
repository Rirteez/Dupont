<?php
namespace App\Models;

use PDO;

class Actu {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM actu ORDER BY date_publication DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM actu WHERE id_actu = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $imageDest, $date) {
        $stmt = $this->pdo->prepare('INSERT INTO actu (title, content, image_actu, date_publication) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$title, $content, $imageDest, $date]);
    }

    public function update($id, $title, $content, $imageDest) {
        $stmt = $this->pdo->prepare('UPDATE actu SET title = ?, content = ?, image_actu = ? WHERE id_actu = ?');
        return $stmt->execute([$title, $content, $imageDest, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM actu WHERE id_actu = ?');
        return $stmt->execute([$id]);
    }
}
?>


