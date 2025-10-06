<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Stand Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/Stands.css?v=2">
</head>
<body>
<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="wrap">
  <div class="row-title">Nieuwe Stand Aanmaken</div>

  <form action="<?php echo URLROOT; ?>/stands/store" method="post" class="create-form">

    <!-- Stand Type -->
    <div class="mb-3">
      <label for="standType" class="form-label"><strong>Type</strong></label>
      <input type="text" class="form-control" id="standType" name="standType" placeholder="Bijv. A of B" required>
    </div>

    <!-- Prijs -->
    <div class="mb-3">
      <label for="prijs" class="form-label"><strong>Prijs (€)</strong></label>
      <input type="number" class="form-control" id="prijs" name="prijs" step="0.01" placeholder="Bijv. 200.00" required>
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
    <button type="submit" class="btn btn-primary">Opslaan</button>
    <a href="/<?php echo URLROOT; ?>/stands/index" class="btn btn-secondary">Annuleren</a>
  </form>
</div>

<div class="container footer container-fluid"> <footer class="py-3 my-4"> <ul class="nav justify-content-center border-bottom pb-3 mb-3 "> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li> </ul> <p class="text-center text-body-secondary">© 2025 Company, Inc</p> </footer> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
