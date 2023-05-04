<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' ];
    public const ADMIN = 1;
    public const SELLER = 2;
    public const USER = 3;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
