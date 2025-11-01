<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    // Permite asignación masiva para 'name' y 'description'
    protected $fillable = ['name', 'description'];
}