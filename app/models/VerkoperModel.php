<?php

class VerkoperModel
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    // Haal alle verkopers
    public function getAlleVerkopers(): array
    {
        $stmt = $this->db->query("SELECT * FROM Verkoper ORDER BY Naam ASC");
        return $stmt->fetchAll() ?: [];
    }

    // Haal 1 verkoper op ID
    public function getVerkoperById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM Verkoper WHERE Id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // Check of naam al bestaat (optioneel excl. huidige ID)
    public function bestaatVerkoper(string $naam, int $excludeId = 0): bool
    {
        $sql = "SELECT COUNT(*) FROM Verkoper WHERE Naam = :naam";
        if ($excludeId > 0) {
            $sql .= " AND Id != :id";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':naam', $naam, PDO::PARAM_STR);
        if ($excludeId > 0) $stmt->bindValue(':id', $excludeId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Nieuwe verkoper toevoegen
    public function addVerkoper(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO Verkoper 
            (Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Opmerking) 
            VALUES (:naam, :status, :soort, :stand, :dagen, :opmerking)");

        $stmt->bindValue(':naam', $data['Naam'], PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['SpecialeStatus'], PDO::PARAM_INT);
        $stmt->bindValue(':soort', $data['VerkooptSoort'], PDO::PARAM_STR);
        $stmt->bindValue(':stand', $data['StandType'], PDO::PARAM_STR);
        $stmt->bindValue(':dagen', $data['Dagen'], PDO::PARAM_STR);
        $stmt->bindValue(':opmerking', $data['Opmerking'] ?: null, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Update verkoper
    public function updateVerkoper(array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE Verkoper SET 
            Naam = :naam,
            SpecialeStatus = :status,
            VerkooptSoort = :soort,
            StandType = :stand,
            Dagen = :dagen,
            Opmerking = :opmerking
            WHERE Id = :id");

        $stmt->bindValue(':id', $data['Id'], PDO::PARAM_INT);
        $stmt->bindValue(':naam', $data['Naam'], PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['SpecialeStatus'], PDO::PARAM_INT);
        $stmt->bindValue(':soort', $data['VerkooptSoort'], PDO::PARAM_STR);
        $stmt->bindValue(':stand', $data['StandType'], PDO::PARAM_STR);
        $stmt->bindValue(':dagen', $data['Dagen'], PDO::PARAM_STR);
        $stmt->bindValue(':opmerking', $data['Opmerking'] ?: null, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Delete verkoper
    public function deleteVerkoper(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM Verkoper WHERE Id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
