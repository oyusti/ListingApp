<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'desc',
        'tags',
        'email',
        'link',
        'image',
        'approved',
    ];

    /**
     * Get the user that owns the listing.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
