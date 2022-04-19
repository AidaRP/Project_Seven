<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'user_id',
        'Game_id'
    ];

    public function games()
    {
        return $this->belongsTo(Game::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
