<?php

namespace App\Providers;

use App\Models\DocumentType;
use Illuminate\Support\ServiceProvider;

class DocumentTypeServiceProvider extends ServiceProvider
{
	public function __construct() {}

	public function store($documentType)
	{
		$msg = 'Document Type Created';
		$httpResponse = 201;

		try {
			$documentType = DocumentType::create($documentType);
		} catch (\Exception $e) {
			$msg = 'It was not possible to save the document type. Error: '.$e;
			$httpResponse = 500;
		}
		return ['message' => $msg, 'data' => $documentType, 'http_response' => $httpResponse];
	}
	
}
