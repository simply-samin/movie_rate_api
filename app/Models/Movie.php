<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'release_year',
        'description',
        'poster_url',
        'genre',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
