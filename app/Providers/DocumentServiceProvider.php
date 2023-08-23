<?php

namespace App\Providers;

use App\Helpers\DocumentTypeHelper;
use App\Models\Document;
use App\Repositories\DocumentRepository;
use Illuminate\Support\ServiceProvider;

class DocumentServiceProvider extends ServiceProvider
{
	private $httpResponse;

	private $msg;

	private $exceptionMessage;

	public function __construct(DocumentRepository $documentRepository) 
	{
		$this->documentRepository = $documentRepository;
		$this->exceptionMessage = '';
	}

	/**
     * Stores a file/document
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     */
	public function store($file, $documentType, $name)
	{
		try {
			#store file in server, in that case localy.
			$data['path'] = $this->storeOnServer($file);
			$data['name'] = $name;
			$data['document_type_id'] = DocumentTypeHelper::getDocumentTypeIdByType($documentType);
			$this->documentRepository->store($data);
		} catch (\Exception $e) {
			$this->exceptionMessage = $e->getMessage(); 
		}

		$this->setResponse();

		return ['message' => $this->msg, 'data' => $data ? $data : '', 'http_response' => $this->httpResponse];
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
	 * Store the file on the server.
	 *
	 * @param \Illuminate\Http\UploadedFile $file
	 * @return string The stored file path
	 */
	private function storeOnServer($file)
	{
		$filename = time() . '_' . $file->getClientOriginalName();
		return $file->storeAs('uploads', $filename, 'local');
	}
}
