<?php
require_once './app/models/CancionModel.php';

class CancionController
{
    private $model;

    public function __construct()
    {
        $this->model = new CancionModel();
    }

    public function getByArtista($req, $res)
    {
        $id_artista = $req->params->id_artista;
        $limit = $req->query->limit ?? null;
        $order = $req->query->order ?? null;
        $page  = $req->query->page ?? null;

        $canciones = $this->model->getByArtist($id_artista, $limit, $order, $page);

        if ($canciones)
            return $res->json($canciones, 200);
        else
            return $res->json(["error" => "No se encontraron canciones para el artista $id_artista"], 404);
    }

    public function getById($req, $res)
    {
        $id_cancion = $req->params->id_cancion;

        $cancion = $this->model->getById($id_cancion);

        if ($cancion)
            return $res->json($cancion, 200);
        else
            return $res->json(["error" => "La canción con id $id_cancion no existe"], 404);
    }

    public function insert($req, $res)
    {
        $id_artista = $req->params->id_artista;
        $body = $req->body;

        if (empty($body->title) || empty($body->duration))
            return $res->json(['error' => 'Faltan datos requeridos: título o duración'], 400);

        $id = $this->model->insert(
            $id_artista,
            $body->title,
            $body->album ?? null,
            $body->duration,
            $body->genre ?? null,
            $body->video ?? null
        );

        return $res->json(['message' => 'Canción creada', 'id' => $id], 201);
    }

    public function update($req, $res)
    {
        $id_cancion = $req->params->id_cancion;
        $body = $req->body;

        $cancion = $this->model->getById($id_cancion);
        if (!$cancion)
            return $res->json(["error" => "La canción no existe"], 404);

        $title = $body->title ?? $cancion->title;
        $album = $body->album ?? $cancion->album;
        $duration = $body->duration ?? $cancion->duration;
        $genre = $body->genre ?? $cancion->genre;
        $video = $body->video ?? $cancion->video;

        $this->model->update($id_cancion, $title, $album, $duration, $genre, $video);

        return $res->json(["message" => "Canción actualizada correctamente"], 200);
    }

    public function delete($req, $res)
    {
        $id_cancion = $req->params->id_cancion;

        $cancion = $this->model->getById($id_cancion);
        if (!$cancion)
            return $res->json(["error" => "La canción no existe"], 404);

        $this->model->delete($id_cancion);
        return $res->json(["message" => "Canción eliminada correctamente"], 200);
    }
}
