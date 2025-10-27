<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Stand Verwijderen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container py-4">
  <h2>Weet je zeker dat je deze stand wilt verwijderen?</h2>

  <div class="alert alert-warning mt-3">
    <p><strong>ID:</strong> <?= htmlspecialchars($data['stand']['Id']) ?></p>
    <p><strong>Type:</strong> <?= htmlspecialchars($data['stand']['StandType']) ?></p>
    <p><strong>Prijs:</strong> €<?= number_format((float)$data['stand']['Prijs'], 2, ',', '.') ?></p>
    <p><strong>Status:</strong> <?= ((int)$data['stand']['VerhuurdStatus'] === 1) ? 'Verhuurd' : 'Beschikbaar' ?></p>
    <?php if (!empty($data['stand']['Opmerking'])): ?>
      <p><strong>Opmerking:</strong> <?= htmlspecialchars($data['stand']['Opmerking']) ?></p>
    <?php endif; ?>
  </div>

  <form action="<?= URLROOT ?>/stands/destroy/<?= (int)$data['stand']['Id'] ?>" method="post" class="d-flex gap-2">
    <a href="<?= URLROOT ?>/stands/index" class="btn btn-outline-secondary">Annuleren</a>
    <button type="submit" class="btn btn-danger">Ja, verwijderen</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
