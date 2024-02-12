<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'donation_request_id', 
    ];

    // Relations: 


    public function donationRequest()
    {
        $this->belongsTo(DonationRequest::class);
    }
    
    public function clients()
    {
        $this->belongsToMany(Client::class)->withPivot('is_read');
    }
}
