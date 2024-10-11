<?php
session_start();
require_once "../database/Database.php";

// Gebruikersklasse
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Methode om wachtwoord te veranderen
    public function changePassword($email, $newPassword, $confirmPassword) {
        // Check of de wachtwoorden overeenkomen
        if ($newPassword !== $confirmPassword) {
            return "De wachtwoorden komen niet overeen.";
        }

        // Versleutel het nieuwe wachtwoord
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update het wachtwoord in de database
        $query = "UPDATE " . $this->table . " SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            return "Wachtwoord succesvol gewijzigd!";
        } else {
            return "Er is een fout opgetreden. Probeer het opnieuw.";
        }
    }
}

// Maak databaseverbinding en gebruikersobject
$database = new Database();
$db = $database->connect();

$user = new User($db);

// Verwerk het formulier
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Wachtwoord wijzigen
    $message = $user->changePassword($email, $newPassword, $confirmPassword);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Vergeten</title>
    <link rel="stylesheet" href="../css/wachtwoordvergeten.css">
</head>
<body>
    <h1>Wachtwoord Vergeten</h1>

    <?php if (isset($message)): ?>
        <p><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="wachtwoordvergeten.php">
        <label for="email">E-mail:</label>
        <input type="email" name="email" required><br><br>

        <label for="new_password">Nieuw Wachtwoord:</label>
        <input type="password" name="new_password" required><br><br>

        <label for="confirm_password">Bevestig Wachtwoord:</label>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">Wachtwoord Wijzigen</button>
    </form>
</body>
</html>

<?php
// Sluit de databaseverbinding
$db->close();
?>
