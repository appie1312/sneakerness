<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Verkoper Verwijderen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container py-4">
  <h2>Weet je zeker dat je deze verkoper wilt verwijderen?</h2>

  <div class="alert alert-warning mt-3">
    <p><strong>ID:</strong> <?= htmlspecialchars($data['verkoper']['Id']) ?></p>
    <p><strong>Naam:</strong> <?= htmlspecialchars($data['verkoper']['Naam']) ?></p>
    <p><strong>Speciale Status:</strong> <?= $data['verkoper']['SpecialeStatus'] ? 'Ja' : 'Nee' ?></p>
    <p><strong>Verkoopt Soort:</strong> <?= htmlspecialchars($data['verkoper']['VerkooptSoort']) ?></p>
    <p><strong>Stand Type:</strong> <?= htmlspecialchars($data['verkoper']['StandType']) ?></p>
    <p><strong>Dagen:</strong> <?= htmlspecialchars($data['verkoper']['Dagen']) ?></p>
    <?php if (!empty($data['verkoper']['Opmerking'])): ?>
      <p><strong>Opmerking:</strong> <?= htmlspecialchars($data['verkoper']['Opmerking']) ?></p>
    <?php endif; ?>
  </div>

  <form action="<?= URLROOT ?>/verkopers/destroy/<?= (int)$data['verkoper']['Id'] ?>" method="post" class="d-flex gap-2">
    <a href="<?= URLROOT ?>/verkopers/index" class="btn btn-outline-secondary">Annuleren</a>
    <button type="submit" class="btn btn-danger">Ja, verwijderen</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
