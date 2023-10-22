<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_phone',
        'patient_age',
        'hospital_name,hospital_address',
        'bags_num',
        'details',
        'latitude',
        'longitude',
        'client_id',
        'blood_type_id',
        'city_id',
    ];
}
