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
}
