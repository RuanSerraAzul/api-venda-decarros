<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
    protected $table = 'carros';

    public $timestamps = false;
    protected $fillable = [
        'modelo',
        'ano',
        'marca',
        'status',
        'valor',
        'vendido'
    ];
}
