<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false; 

    public $fillable = [
        'name',
        'path'
    ];

    protected $attributes = [
        'id' => null,
    ];
}
