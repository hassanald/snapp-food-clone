<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    public const PENDING = 0;
    public const APPROVE = 1;
    public const DELETE_REQ = 2;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'content',
        'answer',
        'score',
        'user_id',
        'cart_id',
        'status',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
