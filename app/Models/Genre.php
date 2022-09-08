<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
