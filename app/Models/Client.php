<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
// class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'password',
        'd_o_b',
        'last_donation_date',
        'blood_type_id',
        'city_id',
    ];

    protected $hidden = [
        'password', 
        'api_token', 
        'pin_code'
    ];

    // Relations: 
    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // public function bloodType()
    // {
    //     return $this->belongsTo(City::class);
    // }

    public function governorates()
    {
        return $this->belongsToMany(Governorate::class);
    }

    public function bloodTypes()
    {
        return $this->belongsToMany(BloodType::class);
    }
}
