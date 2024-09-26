<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = ['title', 'slug', 'image', 'description', 'category_id', 'user_id'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
