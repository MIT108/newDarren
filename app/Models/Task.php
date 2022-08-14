<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'status', 'startDate', 'endDate', 'pdf', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function user_task(){
        return $this->hasMany(UserTask::class);
    }
    public function getPdfAttribute($value){
        return env('APP_URL').Storage::url("pdf/".$value);
    }
}


