<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;
    use Prunable;

    protected $fillable = [
        'link'
    ];

    public function nuxUser(): BelongsTo
    {
        return $this->belongsTo(NuxUser::class);
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subDays(7));
    }
}
