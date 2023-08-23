<?php

namespace App\Helpers;

use App\Models\DocumentType;

class DocumentTypeHelper
{	

	/**
     * Get the document type corresponding to the file name.
     *
     * @param string $fileType
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public static function getDocumentTypeByFileName($fileType)
    {
        return DocumentType::where('name',$fileType)->first();
	}

	/**
     * Get the document type ID corresponding to the file name.
     *
     * @param string $fileType
     * @return string|null
     */
	public static function getDocumentTypeIdByFileName($fileType)
    {
        return self::getDocumentTypeByFileName($fileType)->id;
	}
}