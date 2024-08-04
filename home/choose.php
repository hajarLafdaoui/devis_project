<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de Navbar et Contenu</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Bootstrap Grid Container */
        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Image Styles */
        .image-container a {
            display: block;
            width: 100%;
            height: auto;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        /* Ensure images are responsive */
        @media (min-width: 576px) {
            .image-container a {
                width: calc(50% - 10px); /* Two images per row with gap adjustment */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <!-- Image Container -->
    <div class="container my-4">
        <div class="image-container">
            <a href="../first/first.php"> 
                <img src="1.jpg" alt="Image 1">
            </a>
            <a href="../second/second.php"> 
                <img src="2.jpg" alt="Image 2">
            </a>
            <a href="../third/third.php"> 
                <img src="3.jpg" alt="Image 3">
            </a>
            <a href="../fourth/fourth.php"> 
                <img src="4.jpg" alt="Image 4">
            </a>
        </div>
    </div>

    <!-- GSAP JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <!-- Bootstrap JS et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JS personnalisé -->
    <script src="script.js"></script>

    <!-- GSAP Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.from(".image-container img", {
                duration: 1,
                opacity: 0,
                scale: 0.8,
                stagger: 0.2,
                ease: "power1.out"
            });
        });
    </script>
</body>
</html>
