<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'image' => 'array'
        ];


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

    public function userCourse()
    {
        return $this->belongsToMany(User::class , 'payments');
    }



    public function isPurchase($userId):bool{
        foreach ($this->userCourse()->get() as $item){

            if ($item->id== $userId){
                return true;
            }
        }
        return  false;
    }


    protected static function booted()
    {
        static::retrieved(function ($model) {
        });
    }
}
