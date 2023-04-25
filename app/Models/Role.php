<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' ];
    public const ADMIN = 1;
    public const SELLER = 2;
    public const USER = 3;

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
