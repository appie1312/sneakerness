<?php

class VerkoperModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAlleVerkopers()
    {
        $sql = "SELECT Id, Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Logo, IsActief, Opmerking FROM Verkoper";
        $this->db->query($sql);
        return $this->db->resultSet(); // Geeft een array van objecten terug
    }


}