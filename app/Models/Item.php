<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'is_bought',
        'create_user_id',
    ];

    public function creator() {
        return $this->belongsToOne(User::class, 'create_user_id');
    }

}
