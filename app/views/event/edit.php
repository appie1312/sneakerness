<?php
// Vereist: $pageTitle, $locations (array), $formAction (string), $submitLabel (string)
// Optioneel: $formErrors (array), $old (array met keys: Naam, Datum, Locatie)

$eventImages = [
    'ATHENS'   => 'https://sneakerness.com/app/uploads/Naamloos-2-3-633x600.jpg',
    'BERN'     => 'https://sneakerness.com/app/uploads/zrhweb6.jpg',
    'MILAN'    => 'https://www.hoogstra-autosport.nl/teamkoen/wp-content/uploads/catalog/category/CrossschoenenMILAN.jpg',
    'PARIS'    => 'https://sneakerstack.nl/wp-content/uploads/2023/12/Sneakerness-1024x1024.webp',
    'BUDAPEST' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/03/80/de/a6/shoes-on-the-danube.jpg?w=1200&h=1200&s=1',
];
$defaultImage = URLROOT . '/public/img/placeholders/event-cover.webp';

// Defaults als iets niet gezet is
$pageTitle   = $pageTitle   ?? 'Event wijzigen';
$formAction  = $formAction  ?? (URLROOT . '/event/index');
$submitLabel = $submitLabel ?? 'Wijzigingen Opslaan';
$old         = $old ?? ['Naam' => '', 'Datum' => '', 'Locatie' => ''];
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URLROOT; ?>/public/css/events.css">
    <style>
        .event-preview .card {
            border: 0;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
        }

        .event-preview .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .required::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="events-page">
        <div class="container my-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 m-0"><?= htmlspecialchars($pageTitle) ?></h1>
                <a class="btn btn-outline-secondary btn-sm" href="<?= URLROOT; ?>/event/index">← Terug naar events</a>
            </div>

            <?php if (!empty($formErrors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($formErrors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (!empty($_SESSION['flash_success']) || !empty($_SESSION['flash_error'])): ?>
                <div class="container mt-3">
                    <?php if (!empty($_SESSION['flash_success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($_SESSION['flash_success']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['flash_success']);
                    endif; ?>

                    <?php if (!empty($_SESSION['flash_error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($_SESSION['flash_error']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php unset($_SESSION['flash_error']);
                    endif; ?>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card border-0">
                        <div class="card-body p-4">
                            <form id="eventForm" method="post" action="<?= htmlspecialchars($formAction) ?>" novalidate>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label required">Naam</label>
                                        <input
                                            type="text"
                                            class="form-control <?= !empty($formErrors) && in_array('Deze event kan helaas niet gewijzigd worden. Kies een andere naam.', $formErrors) ? 'is-invalid' : '' ?>"
                                            name="Naam" id="Naam" maxlength="100" required
                                            value="<?= htmlspecialchars($old['Naam'] ?? '') ?>">
                                        <div class="invalid-feedback">
                                            <?= (!empty($formErrors) && in_array('Deze event kan helaas niet gewijzigd worden. Kies een andere naam.', $formErrors))
                                                ? 'Deze event kan helaas niet gewijzigd worden. Kies een andere naam.'
                                                : 'Vul de naam van het event in.'; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label required">Datum</label>
                                        <input type="date" class="form-control" name="Datum" id="Datum" required
                                            value="<?= htmlspecialchars($old['Datum'] ?? '') ?>">
                                        <div class="invalid-feedback">Kies een geldige datum (vandaag of later).</div>
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label required">Locatie</label>
                                        <div class="input-group">
                                            <select class="form-select" id="LocatieSelect" <?= empty($locations) ? 'disabled' : '' ?>>
                                                <option value="">— Kies locatie —</option>
                                                <?php foreach (($locations ?? []) as $loc): ?>
                                                    <option value="<?= htmlspecialchars($loc) ?>"
                                                        <?= (isset($old['Locatie']) && $old['Locatie'] === $loc) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($loc) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" class="form-control" name="Locatie" id="Locatie"
                                                placeholder="Of typ een nieuwe locatie…"
                                                value="<?= htmlspecialchars($old['Locatie'] ?? '') ?>"
                                                required>
                                        </div>
                                        <div class="invalid-feedback">Vul een locatie in.</div>
                                    </div>

                                    <div class="col-12 d-flex gap-2">
                                        <button class="btn btn-dark" type="submit"><?= htmlspecialchars($submitLabel) ?></button>
                                        <a class="btn btn-outline-secondary" href="<?= URLROOT; ?>/event/index">Annuleren</a>
                                    </div>
                                </div>
                            </form>

                            <div id="formMessage" class="alert mt-3 d-none" role="alert"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="event-preview">
                        <div class="card h-100">
                            <img id="PreviewImg" src="<?= $defaultImage ?>" class="card-img-top" alt="Event cover">
                            <div class="card-body">
                                <h5 id="PreviewTitle" class="card-title text-uppercase text-truncate">LOCATIE YYYY</h5>
                                <p id="PreviewSub" class="card-text text-muted">dd maand yyyy</p>
                                <div class="small text-muted" id="PreviewMeta">—</div>
                                <div class="mt-3"><span class="badge bg-secondary" id="PreviewBadge">Coming Soon</span></div>
                                <div class="mt-3"><button class="btn btn-dark btn-sm" type="button" disabled>Buy Tickets</button></div>
                            </div>
                        </div>
                        <div class="form-text mt-2">Live preview zoals op de events-lijst.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container footer container-fluid">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
                <li class="nav-item"><a href="<?= URLROOT; ?>" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
            <p class="text-center text-body-secondary">© 2025 Company, Inc</p>
        </footer>
    </div>

    <script>
        (function() {
            const eventImages = <?= json_encode($eventImages, JSON_UNESCAPED_SLASHES) ?>;
            const defaultImage = '<?= $defaultImage ?>';

            const form = document.getElementById('eventForm');
            const naam = document.getElementById('Naam');
            const datum = document.getElementById('Datum');
            const locatieInput = document.getElementById('Locatie');
            const locatieSelect = document.getElementById('LocatieSelect');

            const prevImg = document.getElementById('PreviewImg');
            const prevTitle = document.getElementById('PreviewTitle');
            const prevSub = document.getElementById('PreviewSub');
            const prevBadge = document.getElementById('PreviewBadge');

            // Min datum = vandaag
            const today = new Date();
            const y = today.getFullYear();
            const m = String(today.getMonth() + 1).padStart(2, '0');
            const d = String(today.getDate()).padStart(2, '0');
            if (datum && !datum.value) datum.min = `${y}-${m}-${d}`;

            if (locatieSelect) {
                locatieSelect.addEventListener('change', () => {
                    if (locatieSelect.value) locatieInput.value = locatieSelect.value;
                    updatePreview();
                });
            }

            function monthName(nlDate) {
                try {
                    return new Intl.DateTimeFormat('nl-NL', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }).format(nlDate);
                } catch {
                    return nlDate.toISOString().slice(0, 10);
                }
            }

            function updatePreview() {
                const loc = (locatieInput && locatieInput.value || '').trim();
                const dat = (datum && datum.value) ? new Date(datum.value + 'T00:00:00') : null;

                const year = dat ? dat.getFullYear() : 'YYYY';
                if (prevTitle) prevTitle.textContent = (loc ? loc.toUpperCase() : 'LOCATIE') + ' ' + year;
                if (prevSub) prevSub.textContent = dat ? monthName(dat) : 'dd maand yyyy';

                if (dat && prevBadge) {
                    const soon = (dat - today) / (1000 * 60 * 60 * 24) > 45;
                    prevBadge.textContent = soon ? 'Coming Soon' : 'Our Event';
                    prevBadge.classList.toggle('bg-secondary', soon);
                    prevBadge.classList.toggle('bg-success', !soon);
                }
                const key = (loc || '').toUpperCase();
                if (prevImg) prevImg.src = eventImages[key] || defaultImage;
            }

            [naam, datum, locatieInput].forEach(el => {
                if (!el) return;
                el.addEventListener('input', updatePreview);
                el.addEventListener('change', updatePreview);
            });
            updatePreview();

            // Client-side validatie (browser post; GEEN preventDefault bij geldige invoer)
            if (form) {
                form.addEventListener('submit', (e) => {
                    let ok = true;
                    if (naam && !naam.value.trim()) {
                        naam.classList.add('is-invalid');
                        ok = false;
                    } else if (naam) {
                        naam.classList.remove('is-invalid');
                    }
                    if (datum && !datum.value) {
                        datum.classList.add('is-invalid');
                        ok = false;
                    }
                    if (locatieInput && !locatieInput.value.trim()) {
                        locatieInput.classList.add('is-invalid');
                        ok = false;
                    } else if (locatieInput) {
                        locatieInput.classList.remove('is-invalid');
                    }
                    if (!ok) e.preventDefault();
                });
            }
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>