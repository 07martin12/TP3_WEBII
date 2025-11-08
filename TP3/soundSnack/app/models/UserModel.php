<?php
require_once './app/database/dbConfig/DBConnection.php';

class UserModel {
    private ?PDO $db;

    public function __construct() {
        $connection = DBConnection::getInstance();
        $this->db = $connection->getPDO();
    }

    public function getByEmail(string $email): ?object {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user ?: null;
    }
}
