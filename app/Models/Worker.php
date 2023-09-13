<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
Use App\Models\Entity;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'last_name', 'dni', 'birthdate', 'address', 'foto', 'user_id']; 
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function entity(){
        return $this->belongsToMany(Entity::class);
    }

}
