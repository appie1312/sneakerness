<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Stands</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="<?= URLROOT ?>/public/css/Stands.css?v=2">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="wrap">
  <div class="row-head">
    <div class="row-title">Aanwezige Stands</div>
  </div>

  <div class="create-stand mb-3">
    <a href="<?= URLROOT ?>/stands/create" class="btn btn-light">Nieuwe Stand Aanmaken</a>
  </div>

  <div class="rail">
    <?php if (empty($data['stands'])): ?>
      <div class="card p-3">
        <h3>Geen stands gevonden</h3>
        <p>Er zijn momenteel geen actieve stands.</p>
      </div>
    <?php else: ?>
      <?php foreach ($data['stands'] as $stand): ?>
        <div class="card p-3 mb-3">
          <h3>Stand #<?= (int)$stand['Id'] ?></h3>
          <p><strong>Type:</strong> <?= htmlspecialchars($stand['StandType']) ?></p>
          <p><strong>Prijs:</strong> €<?= number_format((float)$stand['Prijs'], 2, ',', '.') ?></p>
          <p><strong>Status:</strong> <?= ((int)$stand['VerhuurdStatus'] === 1) ? 'Verhuurd' : 'Beschikbaar' ?></p>
          <?php if (!empty($stand['Opmerking'])): ?>
            <p><strong>Opmerking:</strong> <?= htmlspecialchars($stand['Opmerking']) ?></p>
          <?php endif; ?>
          <p><em>Aangemaakt:</em> <?= htmlspecialchars($stand['DatumAangemaakt']) ?></p>

          <div class="d-flex gap-2 mt-3">
            <a href="<?= URLROOT ?>/stands/edit/<?= (int)$stand['Id'] ?>" class="btn btn-sm btn-warning">Wijzigen</a>
            <a href="<?= URLROOT ?>/stands/delete/<?= (int)$stand['Id'] ?>" class="btn btn-sm btn-danger">Verwijderen</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<div class="container footer container-fluid">
  <footer class="py-3 my-4">
    <!-- ... jouw footer ... -->
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
