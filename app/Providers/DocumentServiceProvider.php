<?php

namespace App\Providers;

use App\Helpers\DocumentTypeHelper;
use App\Models\Document;
use Illuminate\Support\ServiceProvider;

class DocumentServiceProvider extends ServiceProvider
{
	private $httpResponse;

	private $msg;

	private $filePath = '';

	private $exceptionMessage = '';

	public function __construct() {}

	/**
     * Stores a file/document
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
	public function store($file)
	{
		$fileType = $file->getClientOriginalExtension();
		$filename = time() . '_' . $file->getClientOriginalName();

		try {
			$this->filePath = $file->storeAs('uploads', $filename, 'local');
			Document::create([
				'name' => $filename,
				'path' => $this->filePath,
				'document_type_id' => $this->getDocumentTypeId($fileType)
			]);
		} catch (\Exception $e) {
			$this->exceptionMessage = $e->getMessage(); 
		}
		$this->setResponse();
		return ['message' => $this->msg, 'data' => $this->filePath, 'http_response' => $this->httpResponse];
	}

	/**
     * Defines the response sent to controller
     *
     * @param \Exception|null $exception
     * @return void
     */
	private function setResponse($execption = null)
	{
		$this->msg = 'File Uploaded';
		$this->httpResponse = 201;

		if ($this->exceptionMessage) {
			$this->msg = 'It was not possible to upload the file. Error: '.$this->exceptionMessage;
			$this->httpResponse = 500;
		}
	}

	/**
	 * Get the document type ID based on the file type response from Helper
	 *
	 * @param string $fileType
	 * @return string|null
	 */
	private function getDocumentTypeId($fileType)
	{
		return DocumentTypeHelper::getDocumentTypeIdByFileName($fileType);
	}
	
}
