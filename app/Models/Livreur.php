<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livreur extends Model 
{

    use HasApiTokens;

    use HasFactory;

    protected $fillable = [
        'id',
        'nom_livreurs',
        'prenom_livreurs',
        'contact',
        'mdp',
        'photo'
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mdp',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function notes(){
        $this->hasMany(Note::class);
    }
}
