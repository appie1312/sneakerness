<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht Verkopers</title>
</head>
<body>
    <h1>Overzicht van alle verkopers</h1>
    <?php if (empty($verkopers)): ?>
        <p>Momenteel geen verkopers in ons systeem.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Naam</th>
                <th>Speciale Status</th>
                <th>Verkoopt Soort</th>
                <th>Stand Type</th>
                <th>Dagen</th>
                <th>Logo</th>
                <th>Actief</th>
                <th>Opmerking</th>
            </tr>
            <?php foreach ($verkopers as $verkoper): ?>
                <tr>
                    <td><?= htmlspecialchars($verkoper['Naam']) ?></td>
                    <td><?= $verkoper['SpecialeStatus'] ? 'Ja' : 'Nee' ?></td>
                    <td><?= htmlspecialchars($verkoper['VerkooptSoort']) ?></td>
                    <td><?= htmlspecialchars($verkoper['StandType']) ?></td>
                    <td><?= htmlspecialchars($verkoper['Dagen']) ?></td>
                    <td>
                        <?php if (!empty($verkoper['Logo'])): ?>
                            <img src="<?= htmlspecialchars($verkoper['Logo']) ?>" alt="Logo" width="50">
                        <?php endif; ?>
                    </td>
                    <td><?= $verkoper['IsActief'] ? 'Ja' : 'Nee' ?></td>
                    <td><?= htmlspecialchars($verkoper['Opmerking']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
