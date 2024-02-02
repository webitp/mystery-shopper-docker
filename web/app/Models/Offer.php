<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'link_id', 'name', 'reward', 'text_actions', 'text_step_1', 'text_step_2'
    ];

    public function isOwned() {
        $user = Auth::user();
        return $user->id === $this->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
