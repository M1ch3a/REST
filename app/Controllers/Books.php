<?php

namespace App\Controllers\Api;

use App\Models\BookModel;
use CodeIgniter\RESTful\ResourceController;

class Books extends ResourceController
{
    protected $modelName = 'App\Models\BookModel';
    protected $format    = 'json';

    /**
     * GET /api/books
     * Ritorna tutti i libri
     */
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    /**
     * GET /api/books/{id}
     * Ritorna un singolo libro
     */
    public function show($id = null)
    {
        $book = $this->model->find($id);

        if ($book === null) {
            return $this->failNotFound('Libro non trovato');
        }

        return $this->respond($book);
    }

    /**
     * POST /api/books
     * Crea un nuovo libro
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'title'  => 'required|min_length[1]|max_length[255]',
            'author' => 'required|min_length[1]|max_length[255]',
            'year'   => 'required|integer',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $id = $this->model->insert($data);

        return $this->respondCreated(['id' => $id, ...$data]);
    }

    /**
     * PUT /api/books/{id}
     * Aggiorna un libro esistente
     */
    public function update($id = null)
    {
        $book = $this->model->find($id);

        if ($book === null) {
            return $this->failNotFound('Libro non trovato');
        }

        $data = $this->request->getJSON(true);

        $rules = [
            'title'  => 'if_exist|min_length[1]|max_length[255]',
            'author' => 'if_exist|min_length[1]|max_length[255]',
            'year'   => 'if_exist|integer',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);

        return $this->respond($this->model->find($id));
    }

    /**
     * DELETE /api/books/{id}
     * Elimina un libro
     */
    public function delete($id = null)
    {
        $book = $this->model->find($id);

        if ($book === null) {
            return $this->failNotFound('Libro non trovato');
        }

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Libro eliminato']);
    }
}