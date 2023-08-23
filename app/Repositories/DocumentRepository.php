<?php

namespace App\Repositories;

use App\Helpers\DocumentTypeHelper;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function store($data)
    {
        return Document::create($data);
    }
}