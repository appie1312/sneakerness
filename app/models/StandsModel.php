<?php

class StandsModel
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
            throw new Exception("Databaseverbinding mislukt: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Haalt alle actieve stands op (optioneel met verkopernaam)
     */
    public function getStands(): array
    {
        try {
            $sql = "SELECT 
                        s.Id,
                        s.VerkoperId,
                        v.Naam AS VerkoperNaam,
                        s.StandType,
                        s.Prijs,
                        s.VerhuurdStatus,
                        s.IsActief,
                        s.Opmerking,
                        s.DatumAangemaakt,
                        s.DatumGewijzigd
                    FROM Stand s
                    LEFT JOIN Verkoper v ON v.Id = s.VerkoperId
                    WHERE s.IsActief = 1
                    ORDER BY s.Id DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll() ?: [];
        } catch (PDOException $e) {
            throw new Exception("Fout bij ophalen stands: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Haal actieve verkopers (voor <select> in create)
     */
    public function getVerkopers(): array
    {
        try {
            $sql = "SELECT Id, Naam 
                    FROM Verkoper
                    WHERE IsActief = 1
                    ORDER BY Naam ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll() ?: [];
        } catch (PDOException $e) {
            throw new Exception("Fout bij ophalen verkopers: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Nieuwe stand toevoegen (LET OP: VerkoperId is verplicht)
     */
    public function addStand(array $data): bool
    {
        try {
            $sql = "INSERT INTO Stand 
                        (VerkoperId, StandType, Prijs, VerhuurdStatus, Opmerking, IsActief, DatumAangemaakt)
                    VALUES
                        (:verkoperId, :standType, :prijs, :verhuurdStatus, :opmerking, 1, NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':verkoperId',     (int)$data['VerkoperId'],     PDO::PARAM_INT);
            $stmt->bindValue(':standType',      $data['StandType'],           PDO::PARAM_STR);
            $stmt->bindValue(':prijs',          (string)$data['Prijs'],       PDO::PARAM_STR); // DECIMAL als string binden
            $stmt->bindValue(':verhuurdStatus', (int)$data['VerhuurdStatus'], PDO::PARAM_INT);

            // Opmerking mag null zijn
            if ($data['Opmerking'] === null || $data['Opmerking'] === '') {
                $stmt->bindValue(':opmerking', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':opmerking', $data['Opmerking'], PDO::PARAM_STR);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            // Vaak zie je hier een FK error als VerkoperId niet bestaat
            throw new Exception("Fout bij toevoegen stand: " . $e->getMessage(), 0, $e);
        }
    }
}
