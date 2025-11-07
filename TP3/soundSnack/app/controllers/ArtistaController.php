<?php
require_once './app/models/ArtistaModel.php';

class ArtistaController
{
    private $model;

    public function __construct()
    {
        $this->model = new ArtistaModel();
    }

    public function getAll($req, $res)
    {
        $limit = $req->query->limit ?? null;
        $order = $req->query->order ?? null;
        $page  = $req->query->page ?? null;

        $artistas = $this->model->getAll($limit, $order, $page);

        if ($artistas)
            return $res->json($artistas, 200);
        else
            return $res->json(['error' => 'No se encontraron artistas'], 404);
    }

    public function getById($req, $res)
    {
        $id = $req->params->id;
        $artista = $this->model->getById($id);

        if ($artista)
            return $res->json($artista, 200);
        else
            return $res->json(["error" => "El artista con id=$id no existe"], 404);
    }

    public function notFound($req, $res)
    {
        return $res->json(["error" => "Recurso no encontrado"], 404);
    }
}
