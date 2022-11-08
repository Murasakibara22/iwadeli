<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCopie extends Model
{
    use HasFactory;

    protected $fillable = [
        'details',	
        'lieudedepart',
    	'lieudelivraison',	
        'contactdudestinataire',
        'montant',	
        'id_users',	
        'nature',
        'contact',
        'created_at',
        'updated_at'
    ];

    public function use(){
        return $this->belongsTo(User::class, 'id_users');
    }
}
