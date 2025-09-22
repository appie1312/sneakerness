<?php
namespace App\Model;
use PDO;

class EventModel {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getCurrentEvents(int $days = 45): array {
        $sql = "SELECT * FROM Evenement
                WHERE IsActief = 1
                  AND Datum >= CURDATE()
                  AND Datum <= DATE_ADD(CURDATE(), INTERVAL :days DAY)
                ORDER BY Datum ASC";
        $st = $this->db->prepare($sql);
        $st->bindValue(':days', $days, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }

    public function getComingSoonEvents(int $days = 45): array {
        $sql = "SELECT * FROM Evenement
                WHERE IsActief = 1
                  AND Datum > DATE_ADD(CURDATE(), INTERVAL :days DAY)
                ORDER BY Datum ASC";
        $st = $this->db->prepare($sql);
        $st->bindValue(':days', $days, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
}
