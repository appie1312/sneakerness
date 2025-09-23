<?php

class StandsModel
{
    private $db;

    public function __construct()
    {
        // dit stukje maakt connectie met de database
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

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

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        // gooi fout door naar bovenliggende laag
        throw new Exception("Fout bij ophalen stands: " . $e->getMessage(), 0, $e);
    }
}
}
