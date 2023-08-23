<?php

namespace App\Http\Controllers;

use App\Providers\DocumentServiceProvider;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $documentServiceProvider;

    public function __construct(DocumentServiceProvider $documentServiceProvider) {
        $this->documentServiceProvider = $documentServiceProvider;
    }

    /**
     * Store a new document from the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $response = $this->documentServiceProvider->store($file, $request->document_type, $request->name);
                    
            return response()->json($response);
        }

        return response()->json(['message' => 'File not found'], 400);
    }
}