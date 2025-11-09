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

    public function getById(int $id_song): ?object
    {
        $query = $this->db->prepare(
            "SELECT id_song, id_artist, title, album, duration, genre, video 
             FROM songs 
             WHERE id_song = ?"
        );
        $query->execute([$id_song]);
        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song ?: null;
    }

    public function insert(int $id_artist, string $title, ?string $album = null, ?string $duration = null, ?string $genre = null, ?string $video = null): int
    {
        $query = $this->db->prepare("
            INSERT INTO songs (id_artist, title, album, duration, genre, video)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $query->execute([$id_artist, $title, $album, $duration, $genre, $video]);
        return intval($this->db->lastInsertId());
    }

    public function update(int $id_song, string $title, ?string $album = null, ?string $duration = null, ?string $genre = null, ?string $video = null): bool
    {
        $query = $this->db->prepare("
            UPDATE songs
            SET title = ?, album = ?, duration = ?, genre = ?, video = ?
            WHERE id_song = ?
        ");
        return $query->execute([$title, $album, $duration, $genre, $video, $id_song]);
    }

    public function delete(int $id_song): bool
    {
        $query = $this->db->prepare("DELETE FROM songs WHERE id_song = ?");
        return $query->execute([$id_song]);
    }
}
