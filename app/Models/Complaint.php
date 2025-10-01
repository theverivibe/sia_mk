<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'asset_id',
        'user_id',
        'title',
        'description',
        'priority',
        'status',
        'assigned_to',
        'resolution',
        'resolved_at',
        'image',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (!$complaint->ticket_number) {
                $complaint->ticket_number = 'TKT-' . date('Ymd') . '-' . str_pad(Complaint::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
