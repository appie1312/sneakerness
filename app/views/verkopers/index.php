<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht Verkopers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php require_once APPROOT . '/views/includes/header.php'; ?>
    <h1>Overzicht van alle verkopers</h1>
    <?php if (empty($verkopers)): ?>
        <p>Momenteel geen verkopers in ons systeem.</p>
    <?php else: ?>
        <table class="table " border="1">
            <tr>
                <th>Naam</th>
                <th>Speciale Status</th>
                <th>Verkoopt Soort</th>
                <th>Stand Type</th>
                <th>Dagen</th>
                <th>Opmerking</th>
            </tr>
            <?php foreach ($verkopers as $verkoper): ?>
                <tr>
                    <td><?= $verkoper->Naam?></td>
                    <td><?= $verkoper -> SpecialeStatus ? 'Ja' : 'Nee' ?></td>
                    <td><?= $verkoper -> VerkooptSoort ?></td>
                    <td><?= $verkoper -> StandType  ?></td>
                    <td><?= $verkoper -> Dagen  ?></td>
                    <td><?= $verkoper -> Opmerking ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    
<?php require_once APPROOT . '/views/includes/footer.php'; ?>
</body>
</html>
