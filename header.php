<!-- header.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>" />
    <link rel="stylesheet" href="style.css">
    
    <!-- Bootstrap claqué au sol
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="icon" href="https://le-campus-numerique.fr/wp-content/uploads/2020/11/favicon.png" sizes="192x192">
</head>

<body>
    <!-- Barre de navigation -->
    <header class="topbar">
        
        <div class="logo">
            <a href="index.html">
                <div>
                    <img id="logo-campus" src="https://le-campus-numerique.fr/wp-content/uploads/2020/12/logo-campus-header-300x60.png" alt="campus-header.jpg">
                </div>
            </a>
        </div>
        
        <nav class="navbar">
            <ul>
                <li><a href="/index.php?page=home">Index</a></li>
                <li><a href="/index.php?page=about">About</a></li>
                <li><a href="/index.php?page=contact">Contact</a></li>
            </ul>
        </nav>
    </header>