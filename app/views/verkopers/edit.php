<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Verkoper Wijzigen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container py-4">
  <h2>Verkoper #<?= htmlspecialchars($data['verkoper']['Id']) ?> wijzigen</h2>

  <form action="<?= URLROOT ?>/verkopers/update/<?= (int)$data['verkoper']['Id'] ?>" method="post" class="mt-3">

    <div class="mb-3">
      <label for="Naam" class="form-label"><strong>Naam</strong></label>
      <input type="text" class="form-control" id="Naam" name="Naam"
             value="<?= htmlspecialchars($data['verkoper']['Naam']) ?>" required>
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="SpecialeStatus" name="SpecialeStatus"
             <?= $data['verkoper']['SpecialeStatus'] ? 'checked' : '' ?>>
      <label class="form-check-label" for="SpecialeStatus">Speciale Status</label>
    </div>

    <div class="mb-3">
      <label for="VerkooptSoort" class="form-label"><strong>Verkoopt Soort</strong></label>
      <input type="text" class="form-control" id="VerkooptSoort" name="VerkooptSoort"
             value="<?= htmlspecialchars($data['verkoper']['VerkooptSoort']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="StandType" class="form-label"><strong>Stand Type</strong></label>
      <input type="text" class="form-control" id="StandType" name="StandType"
             value="<?= htmlspecialchars($data['verkoper']['StandType']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="Dagen" class="form-label"><strong>Dagen</strong></label>
      <input type="text" class="form-control" id="Dagen" name="Dagen"
             value="<?= htmlspecialchars($data['verkoper']['Dagen']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="Opmerking" class="form-label"><strong>Opmerking</strong></label>
      <textarea class="form-control" id="Opmerking" name="Opmerking"><?= htmlspecialchars($data['verkoper']['Opmerking']) ?></textarea>
    </div>

    <div class="d-flex gap-2">
      <a href="<?= URLROOT ?>/verkopers/index" class="btn btn-outline-secondary">Annuleren</a>
      <button type="submit" class="btn btn-primary">Opslaan</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
