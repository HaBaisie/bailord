<?php
class Database {
    private $conn;

    public function open() {
        try {
            // Hardcoded JawsDB connection (from your heroku config:get JAWSDB_URL)
            $host = 'x3ztd854gaa7on6s.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
            $username = 'zijb2flb22mwbsuq';
            $password = 'tq4ca10018ci57be';
            $dbname = 'gy3lqwi7ocsetsp9';
            $port = 3306;

            $this->conn = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname",
                $username,
                $password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function close() {
        $this->conn = null;
    }
}

$pdo = new Database();
?>