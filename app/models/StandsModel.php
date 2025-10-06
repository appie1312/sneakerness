<?php

class StandsModel
{
    private $db;

    public function __construct()
    {
        // maakt connectie met de database
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
            throw new Exception("Databaseverbinding mislukt: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Haalt alle actieve stands op
     */
    public function getStands(): array
    {
        try {
            $sql = "SELECT 
                        Id,
                        VerkoperId,
                        StandType,
                        Prijs,
                        VerhuurdStatus,
                        IsActief,
                        Opmerking,
                        DatumAangemaakt,
                        DatumGewijzigd
                    FROM Stand
                    WHERE IsActief = 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll() ?: [];
        } catch (PDOException $e) {
            throw new Exception("Fout bij ophalen stands: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Nieuwe stand toevoegen
     */
    public function addStand(array $data): bool
    {
        try {
            $sql = "INSERT INTO Stand 
           (StandType, Prijs, Opmerking, VerhuurdStatus, IsActief, DatumAangemaakt) 
        VALUES 
           (:standType, :prijs, :opmerking, :verhuurdStatus, 1, NOW())";

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':standType', $data['StandType'], PDO::PARAM_STR);
                $stmt->bindValue(':prijs', $data['Prijs'], PDO::PARAM_STR);
                $stmt->bindValue(':opmerking', $data['Opmerking'], PDO::PARAM_STR);
                $stmt->bindValue(':verhuurdStatus', $data['VerhuurdStatus'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Fout bij toevoegen stand: " . $e->getMessage(), 0, $e);
        }
    }
}
