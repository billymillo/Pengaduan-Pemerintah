<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'image',
        'statement',
        'upvotes',
        'viewers'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'report_user');
    }

    public function responses()
    {
        return $this->hasOne(Response::class, 'report_id', 'id');
    }

    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
