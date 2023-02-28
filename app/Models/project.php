<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'author',
        'slug',
        'content',
        'project_date_start',
        'project_date_end',
        'image',
    ];
}
