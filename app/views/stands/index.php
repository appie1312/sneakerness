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
    <?php if (empty($data['stands'])): ?>
      <div class="card">
        <h3>Geen stands gevonden</h3>
        <p>Er zijn momenteel geen actieve stands.</p>
      </div>
    <?php else: ?>
      <?php foreach ($data['stands'] as $stand): ?>
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

<div class="container footer container-fluid"> <footer class="py-3 my-4"> <ul class="nav justify-content-center border-bottom pb-3 mb-3 "> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li> </ul> <p class="text-center text-body-secondary">© 2025 Company, Inc</p> </footer> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>