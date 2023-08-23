<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Document extends File
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false; 

    public $fillable = [
        'path',
        'name',
        'document_type_id',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
