<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht Verkopers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URLROOT ?>/public/css/style.css">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container my-4">
  <div class="d-flex justify-content-between mb-3">
    <h1>Overzicht Verkopers</h1>
    <a href="<?= URLROOT ?>/verkopers/create" class="btn btn-primary">+ Verkoper toevoegen</a>
  </div>

  <?php if (empty($data['verkopers'])): ?>
    <p>Momenteel geen verkopers in het systeem.</p>
  <?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Naam</th>
          <th>Speciale Status</th>
          <th>Verkoopt Soort</th>
          <th>Stand Type</th>
          <th>Dagen</th>
          <th>Opmerking</th>
          <th>Acties</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['verkopers'] as $v): ?>
        <tr>
          <td><?= htmlspecialchars($v['Naam']) ?></td>
          <td><?= $v['SpecialeStatus'] ? 'Ja' : 'Nee' ?></td>
          <td><?= htmlspecialchars($v['VerkooptSoort']) ?></td>
          <td><?= htmlspecialchars($v['StandType']) ?></td>
          <td><?= htmlspecialchars($v['Dagen']) ?></td>
          <td><?= htmlspecialchars($v['Opmerking']) ?></td>
          <td>
            <a href="<?= URLROOT ?>/verkopers/edit/<?= $v['Id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= URLROOT ?>/verkopers/delete/<?= $v['Id'] ?>" class="btn btn-sm btn-danger">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
