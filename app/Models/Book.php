<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'author',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['averageRating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(BookRating::class);
    }

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }

    public function getAverageRatingAttribute()
    {
        $totalRating = 0;

        foreach($this->ratings as $rating)
        {
            $totalRating += $rating->rating_number;
        }

        if(($totalRating == 0) && (count($this->reviews) == 0))
        {
            return 0;
        }else{
            return $totalRating/count($this->reviews); //divided total rating and total review
        }

    }
}
