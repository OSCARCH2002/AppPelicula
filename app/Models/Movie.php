<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_path',
        'backdrop_path',
        'release_date',
        'vote_average',
        'vote_count',
        'original_language',
        'original_title',
        'adult',
        'popularity',
        'media_type',
        'vidapi_id'
    ];

    protected $casts = [
        'adult' => 'boolean',
        'vote_average' => 'decimal:1',
        'vote_count' => 'integer',
    ];

    public function getPosterUrlAttribute()
    {
        if ($this->poster_path) {
            return 'https://image.tmdb.org/t/p/w500' . $this->poster_path;
        }
        return null;
    }

    public function getBackdropUrlAttribute()
    {
        if ($this->backdrop_path) {
            return 'https://image.tmdb.org/t/p/original' . $this->backdrop_path;
        }
        return null;
    }

    public function getFormattedReleaseDateAttribute()
    {
        if ($this->release_date) {
            return \Carbon\Carbon::parse($this->release_date)->format('d/m/Y');
        }
        return null;
    }
}
