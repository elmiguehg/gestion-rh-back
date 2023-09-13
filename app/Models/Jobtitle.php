<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entity;
use App\Models\Category;

class Jobtitle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'importance', 'is_boss', 'category_id'];  
    
    public function entity(){
        return $this->belongsToMany(Entity::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
