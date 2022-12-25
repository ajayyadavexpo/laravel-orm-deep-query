<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Employee;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot(){
        parent::boot();
        static::deleting(function($comment){
            $comment->replies->each(function($reply) {
                $reply->delete();
            });
        });
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function likes()
    {
         return $this->morphMany(Like::class, 'likeable')->where('liked','1');
    }    
}
