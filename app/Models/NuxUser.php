<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NuxUser extends Model
{
    protected $fillable = [
        'username',
        'phonenumber'
    ];

    public function link(): HasOne
    {
        return $this->hasOne(Link::class);
    }

    public function historyGames(): HasMany
    {
        return $this->hasMany(HistoryGame::class);
    }
}
