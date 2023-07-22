<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

    protected $fillable = ['mail_from', 'mail_to', 'unique_name'];

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}

