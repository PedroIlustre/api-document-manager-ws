<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository implements DocumentTypeRepositoryInterface
{
    public function store($data)
    {
		return DocumentType::create($data);
    }
}