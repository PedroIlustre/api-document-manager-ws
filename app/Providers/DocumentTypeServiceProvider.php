<?php

namespace App\Providers;

use App\Models\DocumentType;
use App\Repositories\DocumentTypeRepository;
use Illuminate\Support\ServiceProvider;

class DocumentTypeServiceProvider extends ServiceProvider
{
	private $httpResponse;

	private $msg;

	private $exceptionMessage;

	private $documentTypeRepository;

	public function __construct(DocumentTypeRepository $documentTypeRepository) 
	{
		$this->documentTypeRepository = $documentTypeRepository;
		$this->exceptionMessage = '';
	}

	/**
     * Stores a new document type
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
	public function store($documentType)
	{
		try {
			$documentType = $this->documentTypeRepository->store($documentType);
		} catch (\Exception $e) {
			$this->msg = 'It was not possible to save the document type. Error: '.$e;
		}

		$this->setResponse();

		return [
			'message' => $this->msg, 
			'data' => $documentType ? $documentType : '', 
			'http_response' => $this->httpResponse
		];
	}

	/**
     * Defines the response sent to controller
     *
     * @param \Exception|null $exception
     * @return void
     */
	private function setResponse($execption = null)
	{
		$this->msg = 'Document Type Created';
		$this->httpResponse = 201;

		if ($this->exceptionMessage) {
			$this->msg = 'It was not possible to upload the file. Error: '.$this->exceptionMessage;
			$this->httpResponse = 500;
		}
	}
	
}
