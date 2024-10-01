<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Mass Assignment
    protected $fillable = ['title', 'slug', 'image', 'short_description', 'description', 'category_id', 'user_id', 'is_publish'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function customCreatedAt(): Attribute 
    {
        return Attribute::make(
            get: fn( ) => $this->created_at->diffInDays(now()) < 3 ? $this->created_at->diffForHumans() : Carbon::parse($this->created_at)->settings(['formatFunction' => 'translatedFormat'])->format('j F Y')
        );
    }
}
