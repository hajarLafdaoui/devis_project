<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "devis2";

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO devis (devis_number, agency_city, agency_name, agency_address, agency_phone, agency_email, client_name, client_address, client_phone, client_email, logo, tva) VALUES (:devis_number, :agency_city, :agency_name, :agency_address, :agency_phone, :agency_email, :client_name, :client_address, :client_phone, :client_email, :logo, :tva)");

        // Get form data
        $devis_number = $_POST['devis_number'];
        $agency_city = $_POST['agency_city'];
        $agency_name = $_POST['agencyName'];
        $agency_address = $_POST['agencyAddress'];
        $agency_phone = $_POST['agencyPhone'];
        $agency_email = $_POST['agencyEmail'];
        $client_name = $_POST['clientName'];
        $client_address = $_POST['clientAddress'];
        $client_phone = $_POST['clientPhone'];
        $client_email = $_POST['clientEmail'];
        $tva = $_POST['tva'];

        // Handle logo upload
        $logo = '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
            $logo = '../uploads/' . basename($_FILES['logo']['name']);
            move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
        }

        // Bind parameters
        $stmt->bindParam(':devis_number', $devis_number);
        $stmt->bindParam(':agency_city', $agency_city);
        $stmt->bindParam(':agency_name', $agency_name);
        $stmt->bindParam(':agency_address', $agency_address);
        $stmt->bindParam(':agency_phone', $agency_phone);
        $stmt->bindParam(':agency_email', $agency_email);
        $stmt->bindParam(':client_name', $client_name);
        $stmt->bindParam(':client_address', $client_address);
        $stmt->bindParam(':client_phone', $client_phone);
        $stmt->bindParam(':client_email', $client_email);
        $stmt->bindParam(':logo', $logo);
        $stmt->bindParam(':tva', $tva);

        // Execute the statement
        $stmt->execute();
        $devis_id = $conn->lastInsertId();

        // Insert services
        $stmt_service = $conn->prepare("INSERT INTO services (devis_id, service, description, quantity, price) VALUES (:devis_id, :service, :description, :quantity, :price)");

        $services = $_POST['service'];
        $descriptions = $_POST['description'];
        $quantities = $_POST['quantity'];
        $prices = $_POST['price'];

        for ($i = 0; $i < count($services); $i++) {
            $stmt_service->bindParam(':devis_id', $devis_id);
            $stmt_service->bindParam(':service', $services[$i]);
            $stmt_service->bindParam(':description', $descriptions[$i]);
            $stmt_service->bindParam(':quantity', $quantities[$i]);
            $stmt_service->bindParam(':price', $prices[$i]);
            $stmt_service->execute();
        }

        // Redirect to resFirst.php with the generated devis_id
        header("Location: resFirst.php?id=$devis_id");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
