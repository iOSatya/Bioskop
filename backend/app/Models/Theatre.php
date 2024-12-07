<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theatre extends Model
{
    /** @use HasFactory<\Database\Factories\TheatreFactory> */
    use HasFactory;

    protected $fillable = [
        "theatre_name",
        "rows",
        "columns",
    ];
    
}
