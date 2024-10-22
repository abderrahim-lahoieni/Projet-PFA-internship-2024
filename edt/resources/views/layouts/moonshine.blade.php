<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Statistiques')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="https://zbakhinfo.odoo.com/web/image/446-9257b9e4/logo_encgt.JPG" type="image/jpeg">
</head>
<body>
<header>
    <!-- Add your navigation header here -->
</header>

<main class="container mt-4">
    @yield('content')
</main>

<footer>
    <!-- Add your footer here -->
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
