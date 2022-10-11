<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'part_id',
        'role',
        'confirmed',
    ];

    public function partChanges()
    {
        return $this->hasMany(PartChange::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
