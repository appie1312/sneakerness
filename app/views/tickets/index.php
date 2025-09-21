<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="mb-4">Tickets</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Evenement</th>
                <th>Prijs</th>
                <th>Aantal Tickets</th>
                <th>Datum</th>
                <th>Status</th>
                <th>Opmerking</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data['tickets'] as $ticket): ?>
            <tr>
                <td><?= $ticket['Id'] ?></td>
                <td><?= $ticket['Evenement'] ?></td>
                <td>€ <?= number_format($ticket['Prijs'], 2, ',', '.') ?></td>
                <td><?= $ticket['AantalTickets'] ?></td>
                <td><?= $ticket['Datum'] ?></td>
                <td><?= $ticket['IsActief'] ? 'Actief' : 'Inactief' ?></td>
                <td><?= $ticket['Opmerking'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
