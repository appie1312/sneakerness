<?php
class VerkoperModel
{
    private $db;

    public function __construct($db)
    {
        // hier krijg je een Database-object binnen, dus pak meteen de PDO-verbinding
        $this->db = $db->getConnection();
    }

    public function getAlleVerkopers()
    {
        try {
            $sql = "SELECT Id, Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Logo, IsActief, Opmerking 
                    FROM Verkoper";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); // array van objecten teruggeven
        } catch (PDOException $e) {
            // gooi een exception zodat de controller dit kan opvangen
            throw new Exception("Fout bij ophalen van verkopers: " . $e->getMessage());
        }
    }
}

