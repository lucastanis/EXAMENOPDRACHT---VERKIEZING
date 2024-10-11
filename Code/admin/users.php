<?php
session_start();

// Database klasse
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "verkiezing_db";
    public $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Verbinding mislukt: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}

// Gebruikersklasse
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Haal alle gebruikers op
    public function getAllUsers() {
        $query = "SELECT id, username, email, role, created_at FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result;
    }

    // Verwijder gebruiker
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

// Maak databaseverbinding en gebruikersobject
$database = new Database();
$db = $database->connect();

$user = new User($db);
$result = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <title>Overzicht van Ingelogde Gebruikers</title>
</head>
<body>

<section class="navbar-section">
    <nav class="navbar">
        <div class="logo">JOUW STEM TELT</div>
        <ul>
            <li><a href="homepage.php">TERUG NAAR HOME PAGINA</a></li>
        </ul>
    </nav>
</section>

<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <img src="../img/logo.png" alt="Logo" class="footer-logo" style="width: 125px">
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="admin_overzicht.php">Gebruikers Overzicht</a></li>
            <li><a href="#">Verkiezingen Beheren</a></li>
            <li><a href="#">Live Resultaten</a></li>
            <li><a href="#">Instellingen</a></li>
        </ul>
    </aside>

    <!-- Content Section (CRUD) -->
    <section class="content">
        <h1>Overzicht van Ingelogde Gebruikers</h1>

        <?php if (isset($_GET['message'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Gebruikersnaam</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Aangemaakt op</th>
                <th>Acties</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['role']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="../src/update_user.php?id=<?= $row['id']; ?>">Bewerken</a> | 
                        <a href="delete_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">Verwijderen</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a href="add_user.php"><button>Voeg nieuwe gebruiker toe</button></a>
    </section>
</div>

</body>
</html>

<?php
$db->close();
?>
