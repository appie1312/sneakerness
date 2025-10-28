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
     public function getLocations(): array {
        try {
            $check = $this->db->query("SHOW TABLES LIKE 'Locatie'");
            $hasLocTable = (bool) $check->fetchColumn();

            if ($hasLocTable) {
                $sql = "SELECT DISTINCT l.Naam
                        FROM Locatie l
                        INNER JOIN Evenement e ON e.Locatie = l.Naam
                        ORDER BY l.Naam ASC";
                $st = $this->db->prepare($sql);
                $st->execute();
            } else {
                $sql = "SELECT DISTINCT Locatie AS Naam
                        FROM Evenement
                        ORDER BY Naam ASC";
                $st = $this->db->prepare($sql);
                $st->execute();
            }
            return $st->fetchAll(PDO::FETCH_COLUMN);
        } catch (\Throwable $e) {
            return [];
        }
    }

    // Bestaat er al een event met deze naam?
    public function eventNameExists(string $naam): bool {
        $sql = "SELECT 1 FROM Evenement WHERE LOWER(Naam) = LOWER(:naam) LIMIT 1";
        $st  = $this->db->prepare($sql);
        $st->bindValue(':naam', trim($naam), PDO::PARAM_STR);
        $st->execute();
        return (bool) $st->fetchColumn();
    }

    /**
     * Alleen verplicht: Naam, Datum, Locatie.
     * Overige NOT NULL velden vullen we met veilige defaults.
     */
    public function createEvent(array $data): bool {
        $sql = "INSERT INTO Evenement
                (Naam, Datum, Locatie, AantalTicketsPerTijdslot, BeschikbareStands, IsActief, Opmerking)
                VALUES
                (:Naam, :Datum, :Locatie, :Tickets, :Stands, :IsActief, :Opmerking)";

        $st = $this->db->prepare($sql);
        $st->bindValue(':Naam',     trim($data['Naam']),    PDO::PARAM_STR);
        $st->bindValue(':Datum',    $data['Datum'],         PDO::PARAM_STR); // 'YYYY-MM-DD'
        $st->bindValue(':Locatie',  trim($data['Locatie']), PDO::PARAM_STR);

        // Defaults zodat de call van buitenaf alleen 3 velden hoeft aan te leveren
        $st->bindValue(':Tickets',  1,                      PDO::PARAM_INT);
        $st->bindValue(':Stands',   0,                      PDO::PARAM_INT);
        $st->bindValue(':IsActief', 1,                      PDO::PARAM_INT);
        $st->bindValue(':Opmerking', null,                  PDO::PARAM_NULL);

        return $st->execute();
    }
    public function updateEvent(int $id, array $data): bool
    {
        $sql = "UPDATE Evenement e
            INNER JOIN Locatie l ON e.Locatie = l.Naam
            SET
                e.Naam = :Naam,
                e.Datum = :Datum,
                e.Locatie = :Locatie,
                e.AantalTicketsPerTijdslot = :Tickets,
                e.BeschikbareStands = :Stands,
                e.IsActief = :IsActief,
                e.Opmerking = :Opmerking
            WHERE e.ID = :ID
              AND l.Capaciteit > 0"; // optioneel filter

        $st = $this->db->prepare($sql);

        $st->bindValue(':Naam',     trim($data['Naam']),    PDO::PARAM_STR);
        $st->bindValue(':Datum',    $data['Datum'],         PDO::PARAM_STR);
        $st->bindValue(':Locatie',  trim($data['Locatie']), PDO::PARAM_STR);
        $st->bindValue(':Tickets',  (int)($data['Tickets'] ?? 1),  PDO::PARAM_INT);
        $st->bindValue(':Stands',   (int)($data['Stands']  ?? 0),  PDO::PARAM_INT);
        $st->bindValue(':IsActief', (int)($data['IsActief'] ?? 1),  PDO::PARAM_INT);

        if (isset($data['Opmerking']) && $data['Opmerking'] !== '') {
            $st->bindValue(':Opmerking', $data['Opmerking'], PDO::PARAM_STR);
        } else {
            $st->bindValue(':Opmerking', null, PDO::PARAM_NULL);
        }

        $st->bindValue(':ID', $id, PDO::PARAM_INT);

        return $st->execute();
    }
}
