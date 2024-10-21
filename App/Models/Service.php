<?php
namespace App\Models;

use PDO;

class Service {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM service ORDER BY title');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM service WHERE id_service = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $price) {
        $stmt = $this->pdo->prepare('INSERT INTO service (title, content, price) VALUES (?, ?, ?)');
        return $stmt->execute([$title, $content, $price]);
    }

    public function update($id, $title, $content, $price) {
        $stmt = $this->pdo->prepare('UPDATE service SET title = ?, content = ?, price = ? WHERE id_service = ?');
        return $stmt->execute([$title, $content, $price, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM service WHERE id_service = ?');
        return $stmt->execute([$id]);
    }
}
?>