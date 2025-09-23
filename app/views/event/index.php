<?php
// Mapping Locatie -> Afbeelding
$eventImages = [
    'ATHENS'   => 'https://sneakerness.com/app/uploads/Naamloos-2-3-633x600.jpg',
    'BERN'     => 'https://sneakerness.com/app/uploads/zrhweb6.jpg',
    'MILAN'    => 'https://www.hoogstra-autosport.nl/teamkoen/wp-content/uploads/catalog/category/CrossschoenenMILAN.jpg',
    'PARIS'    => 'https://sneakerstack.nl/wp-content/uploads/2023/12/Sneakerness-1024x1024.webp',
    'BUDAPEST' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/03/80/de/a6/shoes-on-the-danube.jpg?w=1200&h=1200&s=1',
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
 
</body>
</html>