<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'path' ];

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class , 'imageable');
    }

    public function foods(): MorphToMany
    {
        return $this->morphedByMany(Food::class , 'imageable');
    }

    public function restaurant(): MorphToMany
    {
        return $this->morphedByMany(Restaurant::class , 'imageable');
    }
}
