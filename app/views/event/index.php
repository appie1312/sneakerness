<?php
// Mapping Locatie -> Afbeelding
$eventImages = [
    'ATHENS'   => 'https://athenscabs.com/wp-content/uploads/2025/03/Lycabettus-Theatre-Events.webp',
    'BERN'     => 'https://a.storyblok.com/f/272028/4000x2667/098e994d94/01_bern_fanwalk_womens_euro_2025_c_berner-ballzauber_duy_tong.jpg',
    'MILAN'    => 'https://en.locationamilano.it/media/location/thumb/min_97158382d74945338e1e5bedf83a40ec_1525862849.jpg',
    'PARIS'    => 'https://pohcdn.com/sites/default/files/styles/node__blog_post__bp_banner/public/2021-05/Festivals-et-evenements-a-Paris.jpg',
    'BUDAPEST' => 'https://www.corinthia.com/globalassets/hotel-budapest/images/discover-budapest/events-in-budapest_sziget-festival_credit-balazs-moha_szigetfestival.jpg',
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>events</title>
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/events.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<div class="events-page"> <!-- wrapper om styles te scopen -->
  <div class="container my-5">
      <div class="events-grid row"> <!-- twee kolommen layout -->
          <!-- OUR EVENTS -->
          <div class="events-col col-md-6">
              <h2 class="fw-bold mb-4">OUR EVENTS</h2>

              <div class="card-grid row row-cols-1 row-cols-md-2 g-4">
                  <?php if (!empty($ourEvents)): ?>
                      <?php foreach ($ourEvents as $event): ?>
                          <?php
                              $loc = strtoupper(trim($event['Locatie']));
                              $imgSrc = $eventImages[$loc] ?? URLROOT . '/public/img/placeholders/event-cover.webp';
                          ?>
                          <div class="col">
                              <div class="card event-card h-100 shadow-sm border-0">
                                  <img src="<?= $imgSrc ?>"
                                       class="card-img-top event-media" alt="Event cover">
                                  <div class="card-body event-body">
                                      <h5 class="card-title event-title text-uppercase">
                                          <?= htmlspecialchars($event['Locatie']); ?> <?= date('Y', strtotime($event['Datum'])); ?>
                                      </h5>
                                      <p class="card-text event-sub text-muted">
                                          <?= date('d F Y', strtotime($event['Datum'])); ?>
                                      </p>
                                      <div class="event-meta muted">
                                          <!-- voeg hier evt. extra metadata toe -->
                                      </div>
                                      <a href="<?= URLROOT; ?>/event/<?= $event['Id']; ?>" class="btn btn-dark btn-sm">Buy Tickets</a>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <p class="text-muted">Nog geen events beschikbaar.</p>
                  <?php endif; ?>
              </div>
          </div>

          <!-- COMING SOON -->
          <div class="events-col col-md-6">
              <h2 class="fw-bold mb-4">COMING SOON</h2>

              <div class="card-grid row row-cols-1 row-cols-md-2 g-4">
                  <?php if (!empty($comingSoon)): ?>
                      <?php foreach ($comingSoon as $event): ?>
                          <?php
                              $loc = strtoupper(trim($event['Locatie']));
                              $imgSrc = $eventImages[$loc] ?? URLROOT . '/public/img/placeholders/event-cover-dark.webp';
                          ?>
                          <div class="col">
                              <div class="card event-card soon h-100 shadow-sm border-0 bg-dark text-white">
                                  <img src="<?= $imgSrc ?>"
                                       class="card-img-top event-media" alt="Event cover">
                                  <div class="card-body event-body">
                                      <h5 class="card-title event-title text-uppercase">
                                          <?= htmlspecialchars($event['Locatie']); ?> <?= date('Y', strtotime($event['Datum'])); ?>
                                      </h5>
                                      <p class="card-text event-sub">
                                          <?= date('F Y', strtotime($event['Datum'])); ?>
                                      </p>
                                      <span class="tag badge bg-secondary">Coming Soon</span>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <p class="text-muted">Geen toekomstige events.</p>
                  <?php endif; ?>
              </div>
          </div>
      </div>
  </div>
</div>
 
<div class="container footer container-fluid"> <footer class="py-3 my-4"> <ul class="nav justify-content-center border-bottom pb-3 mb-3 "> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li> </ul> <p class="text-center text-body-secondary">© 2025 Company, Inc</p> </footer> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>