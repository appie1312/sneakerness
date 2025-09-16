<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg  bg-light bg-opacity-50">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/<?php echo URLROOT; ?>/homepages/index">SNEAKERNESS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/<?php echo URLROOT; ?>/homepages/index">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/<?php echo URLROOT; ?>#">nog leeg</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/<?php echo URLROOT; ?>#">nog leeg</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <img src="/public/img/wallpaper.jpg" alt="" class="hero">

    <div class="mx-3">
      <div class="col-lg-6 mx-auto text-white mt-5 text-center">
        <h1 class="display-5 fw-bold">welkom bij sneakerness</h1>
        <p class="lead mb-4">in Rotterdam: het ultieme sneaker-event met art, sport, fashion, muziek en exclusieve
          sneakers. Tickets voor zaterdag en zondag beschikbaar.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-light btn-lg px-4 gap-3">Primary button</button>
          <button type="button" class="btn btn-light btn-lg px-4">Secondary</button>
        </div>
      </div>
    </div>
  </header>

<main class="container my-5">

 Kom en ontdek de allernieuwste sneakers, de meest inspirerende muziek, de laatste trends in fashion en een reeks unieke stands op ons bruisende evenement van twee dagen in het hart van Rotterdam. Laat je verrassen door exclusieve releases, ontmoet gelijkgestemde liefhebbers en geniet van een onvergetelijke ervaring vol stijl, creativiteit en entertainment.


</main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
</body>

</html>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>