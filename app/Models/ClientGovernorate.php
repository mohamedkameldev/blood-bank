<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGovernorate extends Model
{
    use HasFactory;

    protected $table = 'client_governorate';

    protected $fillable = [
        'client_id', 
        'governorate_id'
    ];
}
