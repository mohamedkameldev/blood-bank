<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodTypeClient extends Model
{
    use HasFactory;
    
    protected $table = 'blood_type_client';

    protected $fillable = [
        'client_id', 
        'blood_type_id'
    ];
}
