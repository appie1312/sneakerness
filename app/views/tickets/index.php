<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./shadow.css" />
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5 ">
    <h1 class="mb-4">Tickets</h1>
    <a href="<?php echo URLROOT; ?>/tickets/create" class="btn btn-primary mb-3">+ Nieuwe Ticket</a>
    <table class="table table-hover table-style">
        <thead class="table-active">
            <tr>
                <th>ticket id</th>
                <th>evenement</th>
                <th>prijs</th>
                <th>aantal tickets</th>
                <th>datum</th>
                <th>opmerking</th>
                <th>actie</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($data['tickets'])): ?>
        <tr>
            <td colspan="7" class="text-center">Er zijn geen tickets te koop</td>
        </tr>
        <?php else: ?>
        <?php foreach ($data['tickets'] as $ticket): ?>
            <tr>
                <td><?= $ticket['Id'] ?></td>
                <td><?= $ticket['Evenement'] ?></td>
                <td>€<?= $ticket['Prijs'] ?></td>
                <td><?= $ticket['AantalTickets'] ?></td>
                <td><?= $ticket['Datum'] ?></td>
                <td><?= $ticket['Opmerking'] ?></td>
                <td>
                    <a href="<?= URLROOT ?>/tickets/update/<?= $ticket['Id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= URLROOT ?>/tickets/delete/<?= $ticket['Id'] ?>" class="btn btn-sm btn-danger ms-1" onclick="return confirm('Weet je zeker dat je deze ticket wilt verwijderen?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
</body>
</html>
