<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'tid', 'username'
    ];

    public function offers()
    {
        return $this->hasMany(ClientOffer::class)->orderBy('created_at', 'desc');
    }

    public function activeOffer()
    {
        return $this->hasOne(ClientOffer::class)->where('state', '<', 3)->with('offer');
    }
}
