<?php
session_start();    

// Verbinden met de database
$mysqli = new mysqli("localhost", "root", "", "verkiezing_db");

if ($mysqli->connect_error) {
    die("Verbinding mislukt: " . $mysqli->connect_error);
}

// Controleren of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $mysqli->real_escape_string($_POST['login']);
    $password = $_POST['password'];

    // Zoek naar de gebruiker met het opgegeven e-mailadres of gebruikersnaam
    $sql = "SELECT * FROM users WHERE email = '$login' OR username = '$login'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Controleer het wachtwoord
        if (password_verify($password, $user['password'])) {
            // Bewaar gebruikersgegevens in de sessie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect op basis van rol
            if ($user['role'] === 'admin') {
                header('Location: ../admin/users.php'); // Voor admin
            } else {
                header('Location: ../src/homepage.php'); // Voor gewone gebruikers
            }
            exit;
        } else {
            $error = "Onjuist wachtwoord. Probeer opnieuw.";
        }
    } else {
        $error = "Geen account gevonden met deze gebruikersnaam of e-mailadres.";
    }
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add_user.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Login</title>
</head>
<body>
    <section class="navbar-section">
        <nav class="navbar">
            <div class="logo">
                JOUW STEM TELT
            </div>
            <ul>
                <li><a href="homepage.php">HOME</a></li>
                <li><a href="registratie.php">REGISTREREN</a></li>
            </ul>
        </nav>
    </section>

    <div class="container">
        <div class="content">
            <h1>Inloggen</h1>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            
            <form action="login.php" method="POST">
                <label for="login">Gebruikersnaam of E-mail:</label>
                <input type="text" id="login" name="login" required><br><br>

                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" value="Inloggen">
            </form>

            <p>Nog geen account? <a href="../login/registratie.php">Registreer hier</a>.</p>
            <p>Wachtwoord vergeten? <a href="../login/wachtwoordvergeten.php">Klik hier</a>.</p>
        </div>
    </div>
</body>
</html>
