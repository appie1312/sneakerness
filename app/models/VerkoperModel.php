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
            $sql = "SELECT Id, Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, IsActief, Opmerking 
                    FROM Verkoper";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); // array van objecten teruggeven
        } catch (PDOException $e) {
            // gooi een exception zodat de controller dit kan opvangen
            throw new Exception("Fout bij ophalen van verkopers: " . $e->getMessage());
        }
    }

   public function addVerkoper($data)
{
    try {
        $sql = "INSERT INTO Verkoper (Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, IsActief, Opmerking)
                VALUES (:Naam, :SpecialeStatus, :VerkooptSoort, :StandType, :Dagen, :IsActief, :Opmerking)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    } catch (PDOException $e) {
        throw new Exception("Fout bij toevoegen verkoper: " . $e->getMessage());
    }
}


// VerkoperModel.php
    

    public function bestaatVerkoper($naam)
{
        try {
            $sql = "SELECT COUNT(*) as aantal FROM Verkoper WHERE Naam = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$naam]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->aantal > 0;
        } catch (PDOException $e) {
            throw new Exception("Fout bij controleren verkoper: " . $e->getMessage());
        }
}

}

