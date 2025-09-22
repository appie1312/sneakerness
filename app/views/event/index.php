<?php require APPROOT . '/views/includes/header.php'; ?>

<link rel="stylesheet" href="<?= URLROOT; ?>/public/css/events.css">

<?php
// Mapping Locatie -> Afbeelding
$eventImages = [
    'ATHENS'   => 'https://athenscabs.com/wp-content/uploads/2025/03/Lycabettus-Theatre-Events.webp',
    'BERN'     => 'https://www.bern-altstadt.ch/wp-content/uploads/2023/05/GP_2015_IMG_4060-1024x683.jpg',
    'MILAN'    => 'https://designweekguide.com/wp-content/uploads/2024/10/cover-anticipazioni-brera-2024.jpg',
    'PARIS'    => 'https://www.parisinsidersguide.com/image-files/demonstration-may-day-palais-garnier-opera-800-2x1.jpg',
    'BUDAPEST' => 'https://www.triptobudapest.hu/wp-content/uploads/2022/06/Westend-Rooftop-Terrace-845x321.jpg',
];
?>

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
