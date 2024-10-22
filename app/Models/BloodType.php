<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relations
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
