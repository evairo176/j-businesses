<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businesses extends Model
{
    use HasFactory;
    protected $table = 'businesses';
    protected $guarded = ['id'];
}
