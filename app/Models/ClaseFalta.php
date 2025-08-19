<?php

// app/Models/ClaseFalta.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaseFalta extends Model
{
     protected $table = 'clases_faltas';
    protected $fillable = ['nombre'];
}
