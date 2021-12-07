<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
    protected $table = 'historique';
    protected $casts = [
        'created_at' => "datetime:Y-m-d",
        'updated_at' => "datetime:Y-m-d",
    ];
}
