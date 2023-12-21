<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name'
    ];  
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
