<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'spec_id'
    ];

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }
}
