<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="second.css">
</head>
<body>
<div class="container">
    <div class="DevisContainer" id="download">
        <form id="devisForm" action="save_devis.php" method="POST" enctype="multipart/form-data">
            <div class="DevisHeader">
                <div class="DevisHeaderLogo">
                    <div class="data-item logo-container">
                        <!-- Logo Upload -->
                        <input type="file" name="logo" accept="image/*" required>
                    </div>
                </div>
                <div class="DevisHeaderTitle">
                    <div class="DevisHeaderInfo">
                        <p class="devisNumber">Devis N° <input type="text" name="devis_number" value="1" ></p>
                        <p class="agencyCity">Ville: <input type="text" name="agency_city" placeholder="Ville de l'agence"></p>
                        <p class="date"> <?= date('d/m/Y'); ?></p>
                    </div>
                </div>
            </div>
            <div class="ContentWrapper">
                <div class="AgencyInfo">
                    <input type="text" name="agencyName" placeholder="Nom de l'agence" class="form-control mb-2" required>
                    <input type="text" name="agencyAddress" placeholder="Adresse de l'agence" class="form-control mb-2" required>
                    <input type="text" name="agencyPhone" placeholder="Numéro de téléphone de l'agence" class="form-control mb-2" required>
                    <input type="email" name="agencyEmail" placeholder="Email de l'agence" class="form-control mb-2" required>
                </div>
                <div class="ClientInfoWrapper">
                    <div class="ClientInfo">
                        <input type="text" name="clientName" placeholder="Nom du client" class="form-control mb-2" required>
                        <input type="text" name="clientAddress" placeholder="Adresse du client" class="form-control mb-2" required>
                        <input type="text" name="clientPhone" placeholder="Numéro de téléphone du client" class="form-control mb-2" required>
                        <input type="email" name="clientEmail" placeholder="Email du client" class="form-control mb-2" required>
                    </div>
                </div>
            </div>
            <table class="table main-table">
                <thead>
                <tr>
                    <th>Type de Service</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix HT</th>
                </tr>
                </thead>
                <tbody id="servicesTable">
                <tr>
                    <td><input type="text" name="service[]" placeholder="Service Exemple" class="form-control" required></td>
                    <td><input type="text" name="description[]" placeholder="Description Exemple" class="form-control" required></td>
                    <td><input type="number" name="quantity[]" placeholder="" class="form-control" required></td>
                    <td><input type="text" name="price[]" placeholder="" class="form-control" required></td>
                </tr>
                </tbody>
            </table>
            <button type="button" id="addService" class="btn btn-secondary mb-2">Ajouter un service</button>
            <input type="text" name="tva" placeholder="tva(10)" class="form-control mb-2" required>

            <button type="submit" id="saveButton" class="btn mb-2 btn-primary">Enregistrer</button>
        </form>
    </div>
</div>

<script>
    window.onload = function () {
        document.getElementById("addService").addEventListener('click', function() {
            let tableBody = document.getElementById("servicesTable");
            let newRow = document.createElement("tr");

            newRow.innerHTML = `
                <td><input type="text" name="service[]" placeholder="Service Exemple" class="form-control" required></td>
                <td><input type="text" name="description[]" placeholder="Description Exemple" class="form-control" required></td>
                <td><input type="number" name="quantity[]" placeholder="1" class="form-control" required></td>
                <td><input type="text" name="price[]" placeholder="100 Dh" class="form-control" required></td>
            `;

            tableBody.appendChild(newRow);
        });
    }
</script>

</body>
</html>
