<?php
class Database {
    private $conn;

    public function open() {
        try {
            // Heroku JawsDB production configuration
            $host = 'gp96xszpzlqupw4k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
            $username = 'banrexe5vsl57y51';
            $password = 'f4fyvk2apo33jix4';
            $dbname = 'mj4expp0ajllk4js';
            $port = 3306;

            $this->conn = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname",
                $username,
                $password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/certs/ca-certificates.crt'
                )
            );
            return $this->conn;
        } catch (PDOException $e) {
            die("Database connection error. Please try again later.");
        }
    }

    public function close() {
        $this->conn = null;
    }
}

$pdo = new Database();
?>