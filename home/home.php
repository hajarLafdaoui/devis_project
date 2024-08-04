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
</head>
<body>

  <!-- Navbar -->
  <?php include('navbar.php'); ?>

  <!-- Contenu -->
  <div class="container content">
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <h1>Bienvenue sur notre site</h1>
        <h2>Comment créer un devis</h2>
        <p>Pour créer un devis, veuillez remplir le formulaire sur cette page. Assurez-vous d'inclure toutes les informations nécessaires telles que les détails du service, les quantités, et les prix. Cliquez sur le bouton ci-dessous pour commencer.</p>
        <button class="custom-btn btn-5"><a href="choose.php">Créer Devis</a></button>
      </div>
      <div class="col-md-6 col-sm-12">
        <!-- Exemple de formulaire -->
        <img src="numerotation-devis.jpg" alt="Image explicative" class="img-fluid">
      </div>
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

  <script>
    // GSAP Animation
    gsap.from(".content h1", { opacity: 0, y: -50, duration: 1 });
    gsap.from(".content h2", { opacity: 0, y: -50, duration: 1, delay: 0.5 });
    gsap.from(".content p", { opacity: 0, y: -50, duration: 1, delay: 1 });
    gsap.from(".custom-btn", { opacity: 0, y: 50, duration: 1, delay: 1.5 });
  </script>
</body>
</html>
