<?php
session_start();

// Klasse voor navigatie
class Navigation {
    public function displayNavigation() {
        echo '<section class="navbar-section">';
        echo '<nav class="navbar">';
        echo '<a href="../src/homepage.php" class="logo" style="color: white; text-decoration: none;">JOUW STEM TELT</a>';
        echo '<ul>';
        echo '<li><a href="#">STEMPERCENTAGE REGIO\'S</a></li>';
        echo '<li><a href="../src/overzicht.php">OVERZICHT VERKIEZINGEN</a></li>';
        echo '<li><a href="#">STEMMEN</a></li>';
        
        if (isset($_SESSION['user_id'])) {
            echo '<br><li><a href="account.php">Account</a></li>';
        } else {
            echo '<br><li><a href="login.php">INLOGGEN</a></li>';
            echo '<li><a href="registratie.php">REGISTREREN</a></li>';
        }
        
        echo '<li><a href="contact.php">CONTACT</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '</section>';
    }
}

// Klasse voor het overzicht van politieke partijen en kandidaten
class PartyOverview {
    private $parties = [];

    public function __construct() {
        // Voorbeeld data van partijen en kandidaten
        $this->parties = [
            ['name' => 'Partij Naam 1', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 2', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 3', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 4', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 5', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 6', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 7', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
            ['name' => 'Partij Naam 8', 'candidates' => ['Kandidaat 1', 'Kandidaat 2', 'Kandidaat 3']],
        ];
    }

    public function displayParties() {
        echo '<section class="party-list">';
        foreach ($this->parties as $party) {
            echo '<article class="party">';
            echo '<h2>' . $party['name'] . '</h2>';
            echo '<p>Korte beschrijving van de partij.</p>';
            echo '<h3>Kandidaten:</h3>';
            echo '<ul>';
            foreach ($party['candidates'] as $candidate) {
                echo '<li>' . $candidate . '</li>';
            }
            echo '</ul>';
            echo '</article>';
        }
        echo '</section>';
    }
}

// Instanties van de klassen maken en de methodes aanroepen
$navigation = new Navigation();
$partyOverview = new PartyOverview();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht</title>
    <link rel="stylesheet" href="../css/overzicht.css">
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
            <a href="login.php">Stem hier</a>
        </div>
    </section>

    <section class="navbar-section" style="height: 35px"></section>

    <header>
        <h2>Overzicht van Politieke Partijen en Kandidaten</h2>
    </header>

    <main>
        <?php
        // Toon het overzicht van politieke partijen
        $partyOverview->displayParties();
        ?>
    </main>

    <section class="balk-section" style="height: 35px color: white"></section>

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
    