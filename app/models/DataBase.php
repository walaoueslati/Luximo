<?php
// Database.php
class Database {
    private $host = 'localhost'; // Database host
    private $db_name = 'ecommerce'; // Database name
    private $username = 'root'; // Database username
    private $password = ''; // Database password (if any)
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            echo "connected";
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>
