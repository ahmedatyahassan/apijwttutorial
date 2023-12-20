<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name'
    ];  

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
