<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Stand Wijzigen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container py-4">
  <h2>Stand #<?= htmlspecialchars($data['stand']['Id']) ?> wijzigen</h2>

  <form action="<?= URLROOT ?>/stands/update/<?= (int)$data['stand']['Id'] ?>" method="post" class="mt-3">

    <div class="mb-3">
      <label for="verkoperId" class="form-label"><strong>Verkoper</strong></label>
      <select class="form-select" name="verkoperId" id="verkoperId" required>
        <?php foreach ($data['verkopers'] as $v): ?>
          <option value="<?= (int)$v['Id'] ?>" <?= ($v['Id'] == $data['stand']['VerkoperId']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($v['Naam']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="standType" class="form-label"><strong>Type</strong></label>
      <select class="form-select" id="standType" name="standType" required>
        <?php foreach (['A','AA','AA+'] as $type): ?>
          <option value="<?= $type ?>" <?= $data['stand']['StandType'] === $type ? 'selected' : '' ?>>
            <?= $type ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="prijs" class="form-label"><strong>Prijs (€)</strong></label>
      <input type="number" step="0.01" min="0" class="form-control" id="prijs" name="prijs"
             value="<?= htmlspecialchars($data['stand']['Prijs']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="verhuurdStatus" class="form-label"><strong>Status</strong></label>
      <select class="form-select" id="verhuurdStatus" name="verhuurdStatus" required>
        <option value="0" <?= ((int)$data['stand']['VerhuurdStatus'] === 0) ? 'selected' : '' ?>>Beschikbaar</option>
        <option value="1" <?= ((int)$data['stand']['VerhuurdStatus'] === 1) ? 'selected' : '' ?>>Verhuurd</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="opmerking" class="form-label"><strong>Opmerking</strong></label>
      <textarea class="form-control" id="opmerking" name="opmerking"><?= htmlspecialchars($data['stand']['Opmerking']) ?></textarea>
    </div>

    <div class="d-flex gap-2">
      <a href="<?= URLROOT ?>/stands/index" class="btn btn-outline-secondary">Annuleren</a>
      <button type="submit" class="btn btn-primary">Opslaan</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
