<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="description" content="Webseite Immobilien">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $start ? 'start' : ''; ?>">
        
        <div class="container content-header">
            <div class="bar">
                <a href="/">
                    <img class="logo" src="/build/img/logo.avif" alt="Logo Immobilien" />
                </a>

                <div class="mobile-menu">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
                </div>

                <div class="right">
                    <svg class="dark-mode-button" xmlns="http://www.w3.org/2000/svg"  width="50"  height="50"  viewBox="0 0 24 24"  fill="none"  stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                    <nav class="navigation">
                        <a href="about.php">Über uns</a>
                        <a href="listings.php">Anzeige</a>
                        <a href="blog.php">Blog</a>
                        <a href="contact.php">Kontakt</a>
                        <?php if($auth):  ?>
                            <a href="/close-session.php">ausloggen</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div> <!-- .bar -->
            <?php if($start === true){ echo '<h1>Luxusimmobilien: Häuser & Wohnungen zu verkaufen</h1>';} ?>
        </div>
    </header>