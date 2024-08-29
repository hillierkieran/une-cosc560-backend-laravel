<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    protected static function booted()
    {
        static::creating(function (Post $post)
        {
            // If no user_id set, set it to the current user's ID
            if (is_null($post->user_id) && Auth::check()) {
                $post->user_id = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
