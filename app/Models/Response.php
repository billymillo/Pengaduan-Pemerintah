<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_id',
        'responses_status',
        'staff_id'
    ];



    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }

    public function progress()
    {
        // Responses_id akkan tersambung dengan progress
        return $this->hasMany(ResponseProgress::class);
    }
}
