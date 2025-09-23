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
        $sql = "SELECT Id, Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Logo, IsActief, Opmerking 
                FROM Verkoper";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // array van objecten teruggeven
    }
}
