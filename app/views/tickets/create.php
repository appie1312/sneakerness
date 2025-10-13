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

<div class="container mt-4">
    <h2><?php echo $data['title']; ?></h2>

    <form action="<?php echo URLROOT; ?>/tickets/create" method="post">
        <h5>Evenement</h5>
        <div class="mb-3">
            <label class="form-label">Kies Evenement</label>
            <select name="EvenementId" class="form-select">
                <?php foreach($data['evenementen'] as $e): ?>
                    <option value="<?php echo $e['Id']; ?>"><?php echo $e['Naam']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <h5>Prijs (nieuw aanmaken)</h5>
        <div class="mb-3">
            <label class="form-label">Datum</label>
            <input type="date" name="PrijsDatum" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tijdslot</label>
            <input type="text" name="PrijsTijdslot" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tarief</label>
            <input type="number" step="0.01" name="PrijsTarief" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Opmerking</label>
            <textarea name="PrijsOpmerking" class="form-control"></textarea>
        </div>

        <h5>Ticket</h5>
        <div class="mb-3">
            <label class="form-label">Aantal Tickets</label>
            <input type="number" name="AantalTickets" class="form-control" value="1">
        </div>
        <div class="mb-3">
            <label class="form-label">Datum</label>
            <input type="date" name="Datum" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Opmerking</label>
            <textarea name="Opmerking" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>


