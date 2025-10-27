<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Nieuwe Stand Aanmaken</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= URLROOT ?>/public/css/Stands.css?v=2">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="wrap">
  <div class="row-title">Nieuwe Stand Aanmaken</div>

  <form action="<?= URLROOT ?>/stands/store" method="post" class="create-form">

    <!-- Verkoper (verplicht vanwege DB foreign key) -->
    <div class="mb-3">
      <label for="verkoperId" class="form-label"><strong>Verkoper</strong></label>
      <select class="form-select" name="verkoperId" id="verkoperId" required>
        <option value="" disabled selected>Kies een verkoper</option>
        <?php if (!empty($data['verkopers'])): ?>
          <?php foreach ($data['verkopers'] as $v): ?>
            <option value="<?= htmlspecialchars($v['Id']) ?>">
              <?= htmlspecialchars($v['Naam']) ?> (id: <?= (int)$v['Id'] ?>)
            </option>
          <?php endforeach; ?>
        <?php else: ?>
          <option disabled>Geen verkopers beschikbaar</option>
        <?php endif; ?>
      </select>
    </div>

    <!-- Stand Type (ENUM: 'A','AA','AA+') -->
    <div class="mb-3">
      <label for="standType" class="form-label"><strong>Type</strong></label>
      <select class="form-select" id="standType" name="standType" required>
        <option value="A">A</option>
        <option value="AA">AA</option>
        <option value="AA+">AA+</option>
      </select>
    </div>

    <!-- Prijs -->
    <div class="mb-3">
      <label for="prijs" class="form-label"><strong>Prijs (€)</strong></label>
      <input type="number" class="form-control" id="prijs" name="prijs" step="0.01" min="0" placeholder="Bijv. 200.00" required>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label for="status" class="form-label"><strong>Status</strong></label>
      <select class="form-select" id="status" name="verhuurdStatus" required>
        <option value="0">Beschikbaar</option>
        <option value="1">Verhuurd</option>
      </select>
    </div>

    <!-- Opmerking -->
    <div class="mb-3">
      <label for="opmerking" class="form-label"><strong>Opmerking</strong></label>
      <textarea class="form-control" id="opmerking" name="opmerking" placeholder="Bijv. Verhuurd aan Athens Kicks"></textarea>
    </div>

    <!-- Buttons -->
    <div class="d-flex gap-2">
      <a href="<?= URLROOT ?>/stands/index" class="btn btn-outline-secondary">Annuleren</a>
      <button type="submit" class="btn btn-primary">Opslaan</button>
    </div>

  </form>
</div>

<div class="container footer container-fluid">
  <footer class="py-3 my-4">
    <!-- ... jouw footer ... -->
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
