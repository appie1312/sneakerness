<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="mb-4">Contact</h1>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Telefoon</th>
                <th>Email</th>
                <th>Status</th>
                <th>Opmerking</th>
                <th>Aangemaakt</th>
                <th>Gewijzigd</th>
            </tr>
        </thead>
            <tbody>
            <?php if (empty($data['contact'])): ?>
            <tr>
                <td colspan="7" class="text-center">Er zijn geen contactpersonen.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($data['contact'] as $contact): ?>
                <tr>
                    <td><?= $contact['Naam'] ?></td>
                    <td>€ <?= number_format($contact['Telefoon'], 2, ',', '.') ?></td>
                    <td><?= $contact['Email'] ?></td>
                    <td><?= $contact['IsActief'] ? 'Actief' : 'Inactief' ?></td>
                    <td><?= $contact['Opmerking'] ?></td>
                    <td><?= $contact['Aangemaakt'] ?></td>
                    <td><?= $contact['Gewijzigd'] ?></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>
</div>

</body>
</html>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>