<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkiezingen</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Navbar sectie -->
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                Ministerie van Binnenlandse Zaken
            </div>
            <ul>
                <li><a href="{{ route('login') }}">Inloggen</a></li>
                <li><a href="{{ route('register') }}">Registreren</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </section>

    <section class="welcome-section">
    <div class="welcome-content">
        <!-- Welkomstkaart links -->
        <div class="welcome-card">
            <h2>Welkom!</h2>
            <p>Beheer verkiezingen eenvoudig en blijf op de hoogte van de nieuwste politieke ontwikkelingen. Log in of registreer nu om aan de slag te gaan.</p>
            <a href="{{ route('login') }}" class="btn">Inloggen</a>
        </div>
    </div>
</section>



    <!-- Nieuws sectie -->
    <section class="news-section">
        <h2>Laatste Verkiezingsnieuws</h2>
        <div class="news-cards">
            <div class="news-card">
                <img src="{{ asset('img/gemeente.jpg') }}" alt="Nieuws afbeelding 1">
                <h3>Verkiezing Aankondiging</h3>
                <p>Het ministerie heeft de datum voor de komende landelijke verkiezingen bekendgemaakt.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
            <div class="news-card">
                <img src="{{ asset('img/partij.jpg') }}" alt="Nieuws afbeelding 2">
                <h3>Regionale Verkiezingen</h3>
                <p>Gemeenten bereiden zich voor op de regionale verkiezingen.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
            <div class="news-card">
                <img src="{{ asset('img/stemgerechtigde.jpg') }}" alt="Nieuws afbeelding 3">
                <h3>Nieuwe Partijen Geregistreerd</h3>
                <p>Verschillende nieuwe politieke partijen hebben zich aangemeld voor de verkiezingen.</p>
                <a href="#" class="read-more">Lees meer</a>
            </div>
        </div>
    </section>

    <!-- Footer sectie -->
    <section class="footer-section">
        <footer>
            <p>&copy; 2024 Ministerie van Binnenlandse Zaken</p>
        </footer>
    </section>
</body>
</html>
