<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitan extends Model
{
    use HasFactory;
    protected $table = 'capitanes';
    protected $guarded = [];
}
