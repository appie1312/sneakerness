<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="/public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <header>
  <nav class="navbar navbar-expand-lg  bg-light bg-opacity-50">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/homepages/index">SNEAKERNESS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo URLROOT; ?>/homepages/index">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>#">nog leeg</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>#">nog leeg</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <img src="/public/img/wallpaper.jpg" alt="" class="hero">

  <div class="mx-3">
    <div class="col-lg-6 mx-auto text-white mt-5 text-center">
          <h1 class="display-5 fw-bold">welkom bij sneakerness</h1>
      <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-light btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-light btn-lg px-4">Secondary</button>
      </div>
    </div>
  </div>
</header>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>