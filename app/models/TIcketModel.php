<?php

class TicketModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

    public function getTickets()
    {
        try {
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
            return [];
        }
    }

    public function getTicketById($id)
    {
        try {
            $sql = "SELECT Id, EvenementId, PrijsId, AantalTickets, Datum, IsActief, Opmerking
                    FROM Ticket
                    WHERE Id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getEvenementen()
    {
        try {
            $stmt = $this->db->query("SELECT Id, Naam FROM Evenement WHERE IsActief = 1");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    
    public function getPrijzen()
    {
        try {
            $stmt = $this->db->query("SELECT Id, Tarief FROM Prijs WHERE IsActief = 1");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
// Maak een nieuwe prijs aan
    public function createPrijs($data)
{
    try {
        $sql = "INSERT INTO Prijs (Datum, Tijdslot, Tarief, IsActief, Opmerking)
                VALUES (:datum, :tijdslot, :tarief, 1, :opmerking)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':datum', $data['PrijsDatum']);
        $stmt->bindParam(':tijdslot', $data['PrijsTijdslot']);
        $stmt->bindParam(':tarief', $data['PrijsTarief']);
        $stmt->bindParam(':opmerking', $data['PrijsOpmerking']);
        $stmt->execute();
        return $this->db->lastInsertId();
    } catch (PDOException $e) {
        throw new Exception("Fout bij aanmaken prijs: " . $e->getMessage());
    }
}

public function createTicket($data)
{
    try {
        $sql = "INSERT INTO Ticket (EvenementId, PrijsId, AantalTickets, Datum, IsActief, Opmerking)
                VALUES (:evenementId, :prijsId, :aantalTickets, :datum, 1, :opmerking)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':evenementId', $data['EvenementId']);
        $stmt->bindParam(':prijsId', $data['PrijsId']);
        $stmt->bindParam(':aantalTickets', $data['AantalTickets']);
        $stmt->bindParam(':datum', $data['Datum']);
        $stmt->bindParam(':opmerking', $data['Opmerking']);
        $stmt->execute();
        return $this->db->lastInsertId();
    } catch (PDOException $e) {
        throw new Exception("Fout bij aanmaken ticket: " . $e->getMessage());
    }
}
    
    public function updateTicket($post)
    {
        try {
            $sql = "UPDATE Ticket
                    SET EvenementId = :evenementId,
                        PrijsId = :prijsId,
                        AantalTickets = :aantalTickets,
                        Datum = :datum,
                        Opmerking = :opmerking,
                        IsActief = :isActief
                    WHERE Id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':evenementId', $post['EvenementId'], PDO::PARAM_INT);
            $stmt->bindParam(':prijsId', $post['PrijsId'], PDO::PARAM_INT);
            $stmt->bindParam(':aantalTickets', $post['AantalTickets'], PDO::PARAM_INT);
            $stmt->bindParam(':datum', $post['Datum'], PDO::PARAM_STR);
            $stmt->bindParam(':opmerking', $post['Opmerking'], PDO::PARAM_STR);
            $isActief = isset($post['IsActief']) ? (int)$post['IsActief'] : 1;
            $stmt->bindParam(':isActief', $isActief, PDO::PARAM_INT);
            $stmt->bindParam(':id', $post['Id'], PDO::PARAM_INT);

            $success = $stmt->execute();
            if ($success) {
                // retourneer aantal gewijzigde rijen (0 = geen verandering)
                return $stmt->rowCount();
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function delete($Id)
    {
        try {
            $sql = "DELETE FROM Ticket WHERE Id = :Id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
