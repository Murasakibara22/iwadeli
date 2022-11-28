<?php

namespace App\Models;

use App\Models\Livreur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'nbEtoile',
        'details',
        'id_livreurs'
    ];

    public function livreur(){
        $this->belongsTo(Livreur::class, 'id_livreurs');
    }
}
