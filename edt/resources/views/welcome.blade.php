<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="icon" href="https://zbakhinfo.odoo.com/web/image/446-9257b9e4/logo_encgt.JPG" type="image/jpeg">
    <style>

        #hero {
            background: #f8f9fa; /* Couleur de fond */
            padding: 60px 0; /* Espacement vertical */
        }
        .hero-img {
            text-align: center; /* Centrer l'image */
        }
        .btn-get-started {
            background: linear-gradient(45deg, #007bff, #0056b3); /* Gradient background */
            color: white; /* Couleur du texte du bouton */
            border-radius: 5px; /* Coins arrondis */
            padding: 10px 20px; /* Espacement intérieur */
            text-decoration: none; /* Pas de soulignement */
            transition: background 0.3s ease, transform 0.3s ease; /* Transition effects */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
        .btn-get-started:hover {
            background: linear-gradient(45deg, #0056b3, #0056b3); /* Hover gradient */
            transform: scale(1.05); /* Scale effect on hover */
        }
        .btn-get-started h3 {
            font-weight: bold; /* Bold font */
            margin: 0; /* Remove default margin */
        }
        .btn-get-started i {
            margin-left: 8px; /* Space between text and icon */
        }
        #emploi-container {
            margin-top: 50px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<header class="bg-white p-4">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="https://encgt.ma/wp-content/uploads/2022/04/logo-web.png" alt="Logo" class="logo" style="height: 100px;">
    </div>
</header>

<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Plateforme de gestion des emplois du temps.</h1>
                <h3 style="font-size: large" data-aos="fade-up" data-aos-delay="400">
                    Transformez la gestion manuelle de vos emplois du temps en une gestion automatisée et efficace.
                </h3>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <button id="loadEmploi" class="btn-get-started d-inline-flex align-items-center justify-content-center" onclick="window.location.href='/admin/login'">
                            <h3 style="font-size: large">Consulter les emplois du temps</h3>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="https://static.vecteezy.com/system/resources/previews/000/684/259/original/schedule-planning-concept.jpg" class="img-fluid" alt="Hero Image" />
            </div>
        </div>
    </div>
</section>
</body>
</html>
