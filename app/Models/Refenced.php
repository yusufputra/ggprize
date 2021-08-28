<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refenced extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to'
    ];
}
