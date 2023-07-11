<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable=['title', 'location', 'website', 'email', 'description','tags'];

//function to filter the tag by scope
   public function scopeFilter($query, array $filters){
    
    if($filters['tag'] ?? false){
        $query->where('tags', 'like', '%' . request('tag'). '%');
    }
    //FUNction to filter by search form
    if($filters['search'] ?? false){
        $query->where('title', 'like', '%' . request('search'). '%')
        ->orWhere('description', 'like', '%' . request('search'). '%')
        ->orWhere('tags', 'like', '%' . request('search'). '%')
        ->orWhere('location', 'like', '%' . request('search'). '%');
    }
   }
}
