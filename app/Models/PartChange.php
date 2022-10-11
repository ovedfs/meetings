<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'reason',
        'old_user_id',
        'new_user_id',
        'role',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
