<?php
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
?>
