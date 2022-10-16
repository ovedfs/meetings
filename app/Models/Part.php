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

    public function arrendador()
    {
        return $this->belongsTo(User::class, 'part_id');
    }

    public function arrendatario()
    {
        return $this->belongsTo(User::class, 'part_id');
    }

    public function solidario()
    {
        return $this->belongsTo(User::class, 'part_id');
    }

    public function fiador()
    {
        return $this->belongsTo(User::class, 'part_id');
    }
}
