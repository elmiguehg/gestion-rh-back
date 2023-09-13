<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;
use App\Models\Jobtitle;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'identifier'];

    public function worker(){
        return $this->belongsToMany(Worker::class);
    }

    public function jobtitle(){
        return $this->belongsToMany(Jobtitle::class);
    }

}
