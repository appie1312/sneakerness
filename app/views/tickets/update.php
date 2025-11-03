<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ticket bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="mb-4">Ticket bewerken</h1>

    <form action="<?= URLROOT ?>/tickets/update" method="post">
        <input type="hidden" name="Id" value="<?= htmlspecialchars($data['ticket']['Id']) ?>">

        <div class="mb-3">
            <label for="EvenementId" class="form-label">Evenement</label>
            <select name="EvenementId" id="EvenementId" class="form-select">
                <?php foreach ($data['evenementen'] as $ev): ?>
                    <option value="<?= $ev['Id'] ?>" <?= ($ev['Id'] == $data['ticket']['EvenementId']) ? 'selected' : '' ?>><?= htmlspecialchars($ev['Naam']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="PrijsId" class="form-label">Prijs</label>
            <select name="PrijsId" id="PrijsId" class="form-select">
                <?php foreach ($data['prijzen'] as $pr): ?>
                    <option value="<?= $pr['Id'] ?>" <?= ($pr['Id'] == $data['ticket']['PrijsId']) ? 'selected' : '' ?>>€<?= htmlspecialchars($pr['Tarief']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="AantalTickets" class="form-label">Aantal tickets</label>
            <input type="number" name="AantalTickets" id="AantalTickets" class="form-control" value="<?= htmlspecialchars($data['ticket']['AantalTickets']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="Datum" class="form-label">Datum</label>
            <input type="text" name="Datum" id="Datum" class="form-control" value="<?= htmlspecialchars($data['ticket']['Datum']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="Opmerking" class="form-label">Opmerking</label>
            <textarea name="Opmerking" id="Opmerking" class="form-control"><?= htmlspecialchars($data['ticket']['Opmerking']) ?></textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="IsActief" name="IsActief" <?= ($data['ticket']['IsActief']) ? 'checked' : '' ?>>
            <label class="form-check-label" for="IsActief">Actief</label>
        </div>

        <button type="submit" class="btn btn-primary">Wijzig ticket</button>
        <a href="<?= URLROOT ?>/tickets/index" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
</body>
</html>
