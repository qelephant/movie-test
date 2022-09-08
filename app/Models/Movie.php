<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['name', 'status', 'image'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
