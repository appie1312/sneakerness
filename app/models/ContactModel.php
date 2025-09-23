<?php

class ContactModel
{
    private $db;

    public function __construct()
    {
        // dit stukje maakt connectie met de database
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

  public function getContact()
{
    try {
        // dit stuk zorgt ervoor dat alle informatie uit de benodigde tabel wordt gehaald
        $sql = "SELECT Id, 
                       Naam, 
                       Telefoonnummer, 
                       Emailadres, 
                       IsActief,
                       Opmerking,
                       DatumAangemaakt, 
                       DatumGewijzigd
                FROM Contactpersoon
                WHERE IsActief = 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Fout bij ophalen contactpersonen: " . $e->getMessage();
        return [];
    }
}
}
