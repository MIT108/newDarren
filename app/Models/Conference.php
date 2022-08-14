<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;
    protected $fillable = [
        'programed', 'room_id', 'creator', 'status', 'description', 'name'
    ];

    public function conference_user(){
        return $this->hasMany(ConferenceUser::class);
    }
}

