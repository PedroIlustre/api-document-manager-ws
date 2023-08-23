<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentTypeRequest;
use App\Providers\DocumentTypeServiceProvider;

class DocumentTypeController extends Controller
{
    private $documentTypeService;

    public function __construct(DocumentTypeServiceProvider $documentTypeService) 
    {
        $this->documentTypeService = $documentTypeService;
    }

    public function store(DocumentTypeRequest $request)
    {
        $documentType = $request->all();
        $documentTypeResponse = $this->documentTypeService->store($documentType);
        return response()->json($documentTypeResponse, $documentTypeResponse['http_response']);
    }
}
