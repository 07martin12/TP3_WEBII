<?php

require_once './app/database/dbConfig/DBConnection.php';

class CancionModel
{
    private ?PDO $db;

    public function __construct()
    {
        $connection = DBConnection::getInstance();
        $this->db = $connection->getPDO();
    }

    public function getByArtist(int $id_artist, ?int $limit = null, ?string $order = null, ?int $page = null): array
    {
        $sql = "SELECT id_song, id_artist, title, album, duration, genre, video 
                FROM songs 
                WHERE id_artist = ?";

        if ($order === 'alphabetic') {
            $sql .= " ORDER BY title ASC";
        }

        if (!empty($limit) && is_numeric($limit)) {
            $offset = 0;
            if (!empty($page) && is_numeric($page) && $page > 1) {
                $offset = ($page - 1) * $limit;
            }
            $sql .= " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
        }

        $query = $this->db->prepare($sql);
        $query->execute([$id_artist]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id_artist, int $id_song): ?object
    {
        $query = $this->db->prepare(
            "SELECT id_song, id_artist, title, album, duration, genre, video 
             FROM songs 
             WHERE id_artist = ? AND id_song = ?"
        );
        $query->execute([$id_artist, $id_song]);
        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song ?: null;
    }
}
