<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $fillable = [
        'message',
        'date',
        'FromPlayer',
        'PartyId'
    ];
    public function players()
    {
        return $this->belongsTo(User::class);
    }

    public function chats()
    {
        return $this->belongsTo(Party::class);
    }
}
