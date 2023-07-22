<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    use HasFactory;

    protected $fillable = ['path','name'];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
