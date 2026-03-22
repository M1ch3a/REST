<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table      = 'books';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'author', 'year'];

    protected $useTimestamps = false;

    protected $validationRules = [
        'title'  => 'required|min_length[1]|max_length[255]',
        'author' => 'required|min_length[1]|max_length[255]',
        'year'   => 'required|integer',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Il titolo è obbligatorio.',
        ],
        'author' => [
            'required' => "L'autore è obbligatorio.",
        ],
        'year' => [
            'required' => "L'anno è obbligatorio.",
            'integer'  => "L'anno deve essere un numero intero.",
        ],
    ];
}