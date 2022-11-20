<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image'
    ];

    public function spec()
    {
        return $this->hasOne(Spec::class);
    }
}
