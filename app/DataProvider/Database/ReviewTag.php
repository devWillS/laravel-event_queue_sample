<?php

namespace App\DataProvider\Database;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTag extends Model
{
    protected $fillable = ['review_id', 'tag_id', 'created_at'];
    public $timestamps = false;
}
