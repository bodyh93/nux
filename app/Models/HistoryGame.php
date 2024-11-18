<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryGame extends Model
{
    protected $fillable = [
        'number',
        'win',
        'winAmount',
    ];

    public function nuxUser(): BelongsTo
    {
        return $this->belongsTo(NuxUser::class);
    }
}
