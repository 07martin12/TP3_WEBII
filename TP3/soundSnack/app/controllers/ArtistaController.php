<?php
require_once './app/models/ArtistaModel.php';

class ArtistaController
{
    private $model;

    public function __construct()
    {
        $this->model = new ArtistaModel();
    }

    public function getAllArtista($req, $res)
    {
        $limit = $req->query->limit ?? null;
        $order = $req->query->order ?? null;
        $page  = $req->query->page ?? null;

        $artistas = $this->model->getAllArtista($limit, $order, $page);

        if ($artistas)
            return $res->json($artistas, 200);
        else
            return $res->json(['error' => 'No se encontraron artistas'], 404);
    }

    public function getByIdArtista($req, $res)
    {
        $id = $req->params->id;
        $artista = $this->model->getByIdArtista($id);

        if ($artista)
            return $res->json($artista, 200);
        else
            return $res->json(["error" => "El artista con id=$id no existe"], 404);
    }

    public function addArtista($req, $res)
    {
        $body = $req->body;

        if (empty($body->name))
            return $res->json(['error' => 'Falta el nombre del artista'], 400);

        $biography = $body->biography ?? null;
        $cover = $body->cover ?? null;
        $date_of_birth = $body->date_of_birth ?? null;
        $date_of_death = $body->date_of_death ?? null;
        $place_of_birth = $body->place_of_birth ?? null;

        $id = $this->model->addArtista(
            $body->name,
            $biography,
            $cover,
            $date_of_birth,
            $date_of_death,
            $place_of_birth
        );

        return $res->json(['message' => 'Artista creado correctamente', 'id' => $id], 201);
    }

    public function updateArtista($req, $res)
    {
        $id = $req->params->id;
        $body = $req->body;

        $artista = $this->model->getByIdArtista($id);
        if (!$artista)
            return $res->json(["error" => "El artista con id=$id no existe"], 404);

        $this->model->updateArtista(
            $id,
            $body->name ?? $artista->name,
            $body->biography ?? $artista->biography,
            $body->cover ?? $artista->cover,
            $body->date_of_birth ?? $artista->date_of_birth,
            $body->date_of_death ?? $artista->date_of_death,
            $body->place_of_birth ?? $artista->place_of_birth
        );

        return $res->json(["message" => "Artista actualizado correctamente"], 200);
    }

    public function deleteArtista($req, $res)
    {
        $id = $req->params->id;

        $artista = $this->model->getByIdArtista($id);
        if (!$artista)
            return $res->json(["error" => "El artista con id=$id no existe"], 404);

        $this->model->deleteArtista($id);
        return $res->json(["message" => "Artista eliminado correctamente"], 200);
    }

    public function notFoundArtista($req, $res)
    {
        return $res->json(["error" => "Recurso no encontrado"], 404);
    }
}
