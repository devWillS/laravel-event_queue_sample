<?php

namespace App\DataProvider\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'created_at'];
    public $timestamps = false;
}
