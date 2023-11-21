<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function purchase(){
        return $this->hasMany(Purchase::class);
    }


    public function isPurchase($userId):bool{
        foreach ($this->purchase()->get() as $item){
            if ($item->user_id == $userId){
                return true;
            }
        }
        return  false;
    }


}
