<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $ticket_id
 * @property int $rating
 * @property string|null $comment
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    protected static function booted()
    {
        static::creating(function ($review) {
            $review->user_id = auth()->id(); // Automatically assign the logged-in user's ID
        });
    }
}
