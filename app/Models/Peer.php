<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sender_id', 'receiver_id', 'programed', 'room_id', 'status'
    ];
}

