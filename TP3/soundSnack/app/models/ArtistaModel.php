<?php

require_once './app/database/dbConfig/DBConnection.php';

class ArtistaModel
{
    private ?PDO $db;

    public function __construct()
    {
        $connection = DBConnection::getInstance();
        $this->db = $connection->getPDO();
    }

    public function getAll(?int $limit = null, ?string $order = null, ?int $page = null): array
    {
        $sql = "SELECT id_artist, name, biography, cover, date_of_birth, date_of_death, place_of_birth 
                FROM artists";

        if ($order === 'alphabetic') {
            $sql .= " ORDER BY name ASC";
        }

        if (!empty($limit) && is_numeric($limit)) {
            $offset = 0;
            if (!empty($page) && is_numeric($page) && $page > 1) {
                $offset = ($page - 1) * $limit;
            }
            $sql .= " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id_artist): ?object
    {
        $query = $this->db->prepare(
            "SELECT id_artist, name, biography, cover, date_of_birth, date_of_death, place_of_birth 
             FROM artists 
             WHERE id_artist = ?"
        );
        $query->execute([$id_artist]);
        $artist = $query->fetch(PDO::FETCH_OBJ);
        return $artist ?: null;
    }
}
