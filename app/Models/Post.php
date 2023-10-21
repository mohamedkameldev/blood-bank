<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'photo_path',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'favourites', 'client_id', 'post_id');
    }
}
