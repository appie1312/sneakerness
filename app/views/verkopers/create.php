<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/public/css/style.css">

<div class="container my-5">
    <h1 class="mb-4">Nieuwe Verkoper Toevoegen</h1>

    <form action="/<?php echo URLROOT; ?>/verkopers/store" method="POST">

        <!-- Naam -->
        <div class="mb-3">
            <label for="Naam" class="form-label">Naam *</label>
            <input type="text" name="Naam" id="Naam"
                   class="form-control <?php echo isset($errors['Naam']) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $data['Naam'] ?? ''; ?>" required>
            <?php if (isset($errors['Naam'])): ?>
                <div class="invalid-feedback"><?php echo $errors['Naam']; ?></div>
            <?php endif; ?>
        </div>

        <!-- Speciale Status -->
        <div class="mb-3">
            <label for="SpecialeStatus" class="form-label">Speciale Status</label>
            <select name="SpecialeStatus" id="SpecialeStatus" class="form-select" required>
                <option value="0" <?php echo (isset($data['SpecialeStatus']) && $data['SpecialeStatus'] == 0) ? 'selected' : ''; ?>>Nee</option>
                <option value="1" <?php echo (isset($data['SpecialeStatus']) && $data['SpecialeStatus'] == 1) ? 'selected' : ''; ?>>Ja</option>
            </select>
        </div>

        <!-- Verkoopt Soort -->
        <div class="mb-3">
            <label for="VerkooptSoort" class="form-label">Verkoopt Soort</label>
            <select name="VerkooptSoort" id="VerkooptSoort" class="form-select" required>
                <option value="">-- Kies een soort --</option>
                <option value="Sneakers" <?php echo (isset($data['VerkooptSoort']) && $data['VerkooptSoort'] === 'Sneakers') ? 'selected' : ''; ?>>Sneakers</option>
                <option value="Kleding" <?php echo (isset($data['VerkooptSoort']) && $data['VerkooptSoort'] === 'Kleding') ? 'selected' : ''; ?>>Kleding</option>
                <option value="Accessoires" <?php echo (isset($data['VerkooptSoort']) && $data['VerkooptSoort'] === 'Accessoires') ? 'selected' : ''; ?>>Accessoires</option>
                <option value="Overig" <?php echo (isset($data['VerkooptSoort']) && $data['VerkooptSoort'] === 'Overig') ? 'selected' : ''; ?>>Overig</option>
            </select>
        </div>

        <!-- Stand Type -->
        <div class="mb-3">
            <label for="StandType" class="form-label">Stand Type *</label>
            <select name="StandType" id="StandType" class="form-select" required>
                <option value="">-- Kies een standtype --</option>
                <option value="A" <?php echo (isset($data['StandType']) && $data['StandType'] === 'A') ? 'selected' : ''; ?>>A</option>
                <option value="AA" <?php echo (isset($data['StandType']) && $data['StandType'] === 'AA') ? 'selected' : ''; ?>>AA</option>
                <option value="AA+" <?php echo (isset($data['StandType']) && $data['StandType'] === 'AA+') ? 'selected' : ''; ?>>AA+</option>
            </select>
        </div>

        <!-- Dagen -->
        <div class="mb-3">
            <label for="Dagen" class="form-label">Dagen</label>
            <select name="Dagen" id="Dagen" class="form-select" required>
                <option value="">-- Kies dagen --</option>
                <option value="Een dag" <?php echo (isset($data['Dagen']) && $data['Dagen'] === 'Een dag ') ? 'selected' : ''; ?>>Een dag</option>
                <option value="Twee dagen" <?php echo (isset($data['Dagen']) && $data['Dagen'] === 'Twee dagen ') ? 'selected' : ''; ?>>Twee dagen </option>
            </select>
        </div>

        <!-- Is Actief -->
        <div class="mb-3">
            <label for="IsActief" class="form-label">Actief</label>
            <select name="IsActief" id="IsActief" class="form-select">
                <option value="1" <?php echo (isset($data['IsActief']) && $data['IsActief'] == 1) ? 'selected' : ''; ?>>Ja</option>
                <option value="0" <?php echo (isset($data['IsActief']) && $data['IsActief'] == 0) ? 'selected' : ''; ?>>Nee</option>
            </select>
        </div>

        <!-- Opmerking -->
        <div class="mb-3">
            <label for="Opmerking" class="form-label">Opmerking</label>
            <textarea name="Opmerking" id="Opmerking" class="form-control" rows="3"><?php echo $data['Opmerking'] ?? ''; ?></textarea>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-success">Opslaan</button>
            <a href="/<?php echo URLROOT; ?>/verkopers/index" class="btn btn-secondary">Annuleren</a>
        </div>
    </form>
</div>
