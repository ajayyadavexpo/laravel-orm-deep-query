<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;
    // slug
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    } 

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')
            ->orderBy('id','DESC');
    }
    
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable')->where('liked','=','1');
    }
}
