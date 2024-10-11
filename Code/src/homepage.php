<?php
session_start();

// Definieer de SessionManager klasse
class SessionManager {
    public function isUserLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getUserRole() {
        return isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

    public function getUserName() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}

// Definieer de Navigation klasse
class Navigation {
    private $sessionManager;

    public function __construct($sessionManager) {
        $this->sessionManager = $sessionManager;
    }

    public function displayNavigation() {
        echo '<section class="navbar-section">';
        echo '<nav class="navbar">';
        echo '<div class="logo">JOUW STEM TELT</div>';
        echo '<ul>';
        echo '<li><a href="contact.php">Contact</a></li>';

        if ($this->sessionManager->isUserLoggedIn()) {
            echo '<li><a href="account.php">Account</a></li>';
            if ($this->sessionManager->getUserRole() == 'voter' || $this->sessionManager->getUserRole() == 'admin') {
                echo '<li><a href="stemmen.php">Stemmen</a></li>';
            }
        } else {
            echo '<li><a href="../login/login.php">Inloggen</a></li>';
            echo '<li><a href="../login/registratie.php">Registreren</a></li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</section>';
    }
}

// Start de sessie en initialiseer de navigatie
$sessionManager = new SessionManager();
$navigation = new Navigation($sessionManager);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
</head>

<body>
    <?php
    // Toon de navigatie
    $navigation->displayNavigation();
    ?>

    <section class="welcome-section">
        <div class="welcome-content"></div>
        <div class="square-container">
            <h2>SNEL NAAR</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
            <br>
            <a href="../login/login.php">Stem hier</a>
        </div>
    </section>

    <section class="news-section">
        <h2>Laatste Verkiezingsnieuws</h2>
        <div class="news-cards">
            <div class="news-card">
                <img src="../img/gemeente.jpg" alt="">
                <h3>Verkiezing Aankondiging</h3>
                <p>Het ministerie heeft de datum voor de komende landelijke verkiezingen bekendgemaakt.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
            <div class="news-card">
                <img src="../img/partij.jpg" alt="">
                <h3>Regionale Verkiezingen</h3>
                <p>Gemeenten bereiden zich voor op de regionale verkiezingen.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
            <div class="news-card">
                <img src="../img/stemgerechtigde.jpg" alt="">
                <h3>Nieuwe Partijen Geregistreerd</h3>
                <p>Verschillende nieuwe politieke partijen hebben zich aangemeld voor de verkiezingen.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-section logo-section">
            <img src="../img/logo.png" alt="Logo" class="footer-logo">
            <h3 class="footer-title">JOUW STEM TELT</h3>
            <p class="footer-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quae!</p>
        </div>
        <div class="footer-section links-section">
            <h3>Links</h3>
            <div class="links-columns">
                <ul>
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
                <ul>
                    <li><a href="#">Link 5</a></li>
                    <li><a href="#">Link 6</a></li>
                    <li><a href="#">Link 7</a></li>
                    <li><a href="#">Link 8</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-section newsletter-section">
            <h3>Nieuwsbrief</h3>
            <form>
                <input type="email" placeholder="Voer je e-mail in" required>
                <button type="submit">Aanmelden</button>
            </form>
        </div>
    </footer>

</body>

</html>
