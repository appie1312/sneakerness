<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Stands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/Stands.css">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="wrap">
  <div class="row-head">
    <div class="row-title">Aanwezige Stands</div>
  </div>

  <div class="rail">
    <?php if (empty($stands)): ?>
      <div class="card">
        <h3>Geen stands gevonden</h3>
        <p>Er zijn momenteel geen actieve stands.</p>
      </div>
    <?php else: ?>
      <?php foreach ($stands as $stand): ?>
        <div class="card">
          <h3>Stand #<?= htmlspecialchars($stand['Id']) ?></h3>
          <p><strong>Type:</strong> <?= htmlspecialchars($stand['StandType']) ?></p>
          <p><strong>Prijs:</strong> €<?= number_format((float)$stand['Prijs'], 2, ',', '.') ?></p>
          <p><strong>Status:</strong> <?= ((int)$stand['VerhuurdStatus'] === 1) ? 'Verhuurd' : 'Beschikbaar' ?></p>
          <?php if (!empty($stand['Opmerking'])): ?>
            <p><strong>Opmerking:</strong> <?= htmlspecialchars($stand['Opmerking']) ?></p>
          <?php endif; ?>
          <p><em>Aangemaakt:</em> <?= htmlspecialchars($stand['DatumAangemaakt']) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>
</body>
</html>


  

</body>
</html>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>