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
        $id_artista = $req->params->id_artista;
        $id_cancion = $req->params->id_cancion;

        $cancion = $this->model->getById($id_artista, $id_cancion);

        if ($cancion)
            return $res->json($cancion, 200);
        else
            return $res->json(["error" => "La canción $id_cancion no existe para el artista $id_artista"], 404);
    }

    public function insert($req, $res)
    {
        $id_artista = $req->params->id_artista;
        $body = $req->body;

        if (empty($body->titulo) || empty($body->duracion))
            return $res->json(['error' => 'Faltan datos requeridos: título o duración'], 400);

        $id = $this->model->insert($id_artista, $body->titulo, $body->duracion);

        return $res->json(['message' => 'Canción creada', 'id' => $id], 201);
    }

    public function update($req, $res)
    {
        $id_artista = $req->params->id_artista;
        $id_cancion = $req->params->id_cancion;
        $body = $req->body;

        $cancion = $this->model->getById($id_artista, $id_cancion);
        if (!$cancion)
            return $res->json(["error" => "La canción no existe"], 404);

        $this->model->update(
            $id_artista,
            $id_cancion,
            $body->titulo ?? $cancion->titulo,
            $body->duracion ?? $cancion->duracion
        );

        return $res->json(["message" => "Canción actualizada correctamente"], 200);
    }

    public function delete($req, $res)
    {
        $id_artista = $req->params->id_artista;
        $id_cancion = $req->params->id_cancion;

        $cancion = $this->model->getById($id_artista, $id_cancion);
        if (!$cancion)
            return $res->json(["error" => "La canción no existe"], 404);

        $this->model->delete($id_artista, $id_cancion);
        return $res->json(["message" => "Canción eliminada correctamente"], 200);
    }
}
