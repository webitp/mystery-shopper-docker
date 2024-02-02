<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOffer extends Model
{
    use HasFactory;

    public static $statuses = [
        [
            'text' => 'Ожидает получения',
            'color' => 'gray'
        ],
        [
            'text' => 'Ожидает модерации',
            'color' => 'orange'
        ],
        [
            'text' => 'Ожидает отчета',
            'color' => 'orange'
        ],
        [
            'text' => 'Выполнен',
            'color' => 'green'
        ],
        [
            'text' => 'Отклонен',
            'color' => 'red'
        ]
    ];

    protected $fillable = [
        'client_id', 'offer_id', 'state'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function status()
    {
        return self::$statuses[$this->state];
    }
}
