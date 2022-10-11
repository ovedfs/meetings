<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'reason',
        'field',
        'old_value',
        'new_value',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
