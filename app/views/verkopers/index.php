<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht Verkopers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php require_once APPROOT . '/views/includes/header.php'; ?>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Overzicht van alle verkopers</h1>

            <!--Toevoeg knop -->
            <a href="<?php echo URLROOT; ?>/verkopers/create" class="btn btn-primary">
                + Verkoper toevoegen
            </a>
        </div>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div id="success-alert" class="alert alert-success">
                Verkoper succesvol toegevoegd!
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.display = 'none';
                    }
                }, 3000);
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'exists'): ?>
            <div id="error-alert" class="alert alert-danger">
                Verkoper bestaat al hij is niet toegevoegd!
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('error-alert');
                    if (alert) {
                        alert.style.display = 'none';
                    }
                }, 3000);
            </script>
        <?php endif; ?>

        <?php 
        try {
            if (empty($verkopers)) {
                echo "<p>Momenteel geen verkopers in ons systeem.</p>";
            } else {
                echo '<table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Naam</th>
                                <th>Speciale Status</th>
                                <th>Verkoopt Soort</th>
                                <th>Stand Type</th>
                                <th>Dagen</th>
                                <th>Opmerking</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($verkopers as $verkoper) {
                    echo '<tr>
                            <td>' . $verkoper->Naam . '</td>
                            <td>' . ($verkoper->SpecialeStatus ? 'Ja' : 'Nee') . '</td>
                            <td>' . $verkoper->VerkooptSoort . '</td>
                            <td>' . $verkoper->StandType . '</td>
                            <td>' . $verkoper->Dagen . '</td>
                            <td>' . $verkoper->Opmerking . '</td>
                          </tr>';
                }
                echo '</tbody></table>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Er is een fout opgetreden: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>
    
    <?php require_once APPROOT . '/views/includes/footer.php'; ?>
</body>
</html>
