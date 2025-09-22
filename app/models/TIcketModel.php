<?php

class TicketModel
{
    private $db;

    public function __construct()
    {
        // dit stukje maakt connectie met de database
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

    public function getTickets()
    {
        try {
            // dit stuk zorgt ervoor dat alle informatie uit de benodigde tabel wordt gehaald
            $sql = "SELECT Ticket.Id, Evenement.Naam AS Evenement, Prijs.Tarief AS Prijs, 
                           Ticket.AantalTickets, Ticket.Datum, Ticket.IsActief, Ticket.Opmerking
                    FROM Ticket
                    INNER JOIN Evenement ON Ticket.EvenementId = Evenement.Id
                    INNER JOIN Prijs ON Ticket.PrijsId = Prijs.Id
                    WHERE Ticket.IsActief = 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout bij ophalen tickets: " . $e->getMessage();
            return [];
        }
    }
}
