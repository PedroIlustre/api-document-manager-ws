<?php

namespace App\Helpers;

use App\Models\DocumentType;

class DocumentTypeHelper
{	

	/**
     * Get the document type corresponding to the file name.
     *
     * @param string $documentType
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public static function getDocumentTypeByType($documentType)
    {
        return DocumentType::where('type', $documentType)->firstOrFail();
	}

	/**
     * Get the document type ID corresponding to the file name.
     *
     * @param string $documentType
     * @return string|null
     */
	public static function getDocumentTypeIdByType($documentType)
    {
        return self::getDocumentTypeByType($documentType)->id;
	}
}