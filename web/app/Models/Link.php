<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'initial_link', 'link'
    ];

    public function isOwned() {
        $user = Auth::user();
        return $user->id === $this->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function full()
    {
        return route('redirect', [
            'url' => $this->link
        ]);
    }
}
