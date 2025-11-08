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

    public function getAllArtista(?int $limit = null, ?string $order = null, ?int $page = null): array
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

    public function getByIdArtista(int $id_artist): ?object
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

    public function addArtista(string $name, ?string $biography = null, ?string $cover = null, ?string $date_of_birth = null, ?string $date_of_death = null, ?string $place_of_birth = null): int
    {
        $query = $this->db->prepare("
            INSERT INTO artists (name, biography, cover, date_of_birth, date_of_death, place_of_birth)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $query->execute([$name, $biography, $cover, $date_of_birth, $date_of_death, $place_of_birth]);
        return intval($this->db->lastInsertId());
    }

    public function updateArtista(int $id_artist, string $name, ?string $biography = null, ?string $cover = null, ?string $date_of_birth = null, ?string $date_of_death = null, ?string $place_of_birth = null): bool
    {
        $query = $this->db->prepare("
            UPDATE artists
            SET name = ?, biography = ?, cover = ?, date_of_birth = ?, date_of_death = ?, place_of_birth = ?
            WHERE id_artist = ?
        ");
        return $query->execute([$name, $biography, $cover, $date_of_birth, $date_of_death, $place_of_birth, $id_artist]);
    }

    public function deleteArtista(int $id_artist): bool
    {
        $query = $this->db->prepare("DELETE FROM artists WHERE id_artist = ?");
        return $query->execute([$id_artist]);
    }
}
