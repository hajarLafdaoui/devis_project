<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "devis2";

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the devis ID from the URL
    $devis_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($devis_id > 0) {
        // Fetch the devis data
        $stmt = $conn->prepare("SELECT * FROM devis WHERE id = :id");
        $stmt->bindParam(':id', $devis_id);
        $stmt->execute();
        $devis = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the services data
        $stmt_service = $conn->prepare("SELECT * FROM services WHERE devis_id = :devis_id");
        $stmt_service->bindParam(':devis_id', $devis_id);
        $stmt_service->execute();
        $services = $stmt_service->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Invalid devis ID.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="default.css"> -->
     <!-- <link rel="stylesheet" href="first.css"> -->
     <!-- <link rel="stylesheet" href="second.css"> -->
     <!-- <link rel="stylesheet" href="third.css"> -->
     <link rel="stylesheet" href="forth.css">
</head>
<body>
<div class="container ">
    <div class="DevisContainer " id='download'>
        <div class="color">
        <div class="top">
            <div class="DevisHeader">
                <div class="DevisHeaderLogo">
                <div class="data-item logo-container">
                    <!-- Logo -->
                    <img src="<?php echo htmlspecialchars($devis['logo']); ?>" alt="Logo">
                </div>    
                <p class='agency-name'><?php echo htmlspecialchars($devis['agency_name']); ?></p>

                </div>
            </div>
            <div class="DevisHeaderTitle">
                    <div class="DevisHeaderInfo">
                    <p class="devisNumber">Devis N° <?php echo htmlspecialchars($devis['devis_number']); ?></p>
                    <p class="agencyCity"><?php echo htmlspecialchars($devis['agency_city']); ?></p>
                    <p class="date"><?= date('d/m/Y'); ?></p>

                    </div>
            </div>
          
        </div>
        <p class='contact-info'>
            <?php echo htmlspecialchars($devis['agency_address']) . ', ' . htmlspecialchars($devis['agency_phone']) . ', <br> ' . htmlspecialchars($devis['agency_email']); ?>
        </p>
        </div>
        
        

        <div class="ContentWrapper">
       
            <div class="ClientInfoWrapper">
                <div class="ClientInfo">
                <p class='fullName'><?php echo htmlspecialchars($devis['client_name']); ?></p>
                    <p class='clientAddress'><?php echo htmlspecialchars($devis['client_address']); ?></p>
                    <p class='clientNumber'><?php echo htmlspecialchars($devis['client_phone']); ?></p>
                    <p class='clientEmail'><?php echo htmlspecialchars($devis['client_email']); ?></p>
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
                <th>Total HT</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totalHT = 0;
            foreach ($services as $service) {
                $service_name = htmlspecialchars($service['service']);
                $description = htmlspecialchars($service['description']);
                $quantity = intval($service['quantity']);
                $price = floatval($service['price']);
                $montantHT = $price * $quantity;
                $totalHT += $montantHT;
                echo "<tr>
                        <td class='Service'>$service_name</td>
                        <td>$description</td>
                        <td class='quantity'>$quantity</td>
                        <td class='price'>" . number_format($price, 2) . " Dh</td>
                        <td class='total-ht'>" . number_format($montantHT, 2) . " Dh</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>

        <div class="section">
            <div class="condition">
                <p class= 'p-condition'>Conditions génerales:
                    <br>
                </p>
                <ul>
                    <li>...............................................</li>
                    <li>...............................................</li>
                </ul>
            </div>
            <table class="footer-table">
                <tr>
                    <td><strong>Total HT:</strong></td>
                    <td id="totalHT"><?php echo $totalHT; ?> Dh</td>
                </tr>
                <tr>
                    <td><strong>TVA (<?php echo htmlspecialchars($devis['tva']); ?>%):</strong></td>
                    <td id="tva"><?php echo $totalHT * ($devis['tva'] / 100); ?> Dh</td>
                </tr>
                <tr>
                    <td><strong>Total TTC:</strong></td>
                    <td id="totalTTC"><?php echo $totalHT * (1 + ($devis['tva'] / 100)); ?> Dh</td>
                </tr>
            </table>
        </div>
     
        <p class='veuillez'>Veuillez confirmer que vous acceptez ce devis:</p>
     <div class="third">
            
            <div class="singature" style="display: block;">
                <p><strong>Singature</strong></p>
                <div class="inp"></div>
            </div>
            <div class="DateSin">
                <p><strong>Date de Singature</strong></p>
                <div class="inp"></div>
            </div>
        </div>

        <p class='fin'>
            Si vous avez des questions concernant ce devis, veuillez contacter Caroline <br> Dufour à l'adresse <?php echo htmlspecialchars($devis['agency_email']); ?>.fr. Merci pour vos achatas!
        </p>
     
      
   
    </div>
<button id='Download'>Download</button>

</div>


 <!-- pdf -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.min.js" integrity="sha512-MpDFIChbcXl2QgipQrt1VcPHMldRILetapBl5MPCA9Y8r7qvlwx1/Mc9hNTzY+kS5kX6PdoDq41ws1HiVNLdZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script>
  function calculateTotals() {
        let totalHT = 0;
        let tva = parseFloat(<?php echo isset($devis['tva']) ? $devis['tva'] : 0; ?>);
        let totalTTC = 0;

        document.querySelectorAll('.price').forEach(function (element, index) {
            let price = parseFloat(element.textContent.replace(' Dh', '').trim());
            let quantity = parseInt(document.querySelectorAll('.quantity')[index].textContent.trim());

            let montantHT = price * quantity;
            document.querySelectorAll('.total-ht')[index].textContent = montantHT + ' Dh';
            totalHT += montantHT;
        });

        let tvaAmount = totalHT * (tva / 100);
        totalTTC = totalHT + tvaAmount;

        document.getElementById('totalHT').textContent = totalHT + ' Dh';
        document.getElementById('tva').textContent = tvaAmount + ' Dh';
        document.getElementById('totalTTC').textContent = totalTTC + ' Dh';
    }
    window.onload = function () {
    calculateTotals();

    document.getElementById("Download").addEventListener('click', function() {
        const devis = document.getElementById('download');
        var opt = {
            margin:       0,
            filename:     'devis.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' } 
        };

        html2pdf().set(opt).from(devis).save();
    });
}

</script>


</body>
</html>
