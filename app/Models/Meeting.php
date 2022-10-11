<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'place',
        'status_id',
        'admin_abogado_id',
        'abogado_id',
    ];

    public function meetingChanges()
    {
        return $this->hasMany(MeetingChange::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function abogado()
    {
        return $this->belongsTo(User::class, 'abogado_id');
    }

    public function abogadoAdmin()
    {
        return $this->belongsTo(User::class, 'abogado_admin_id');
    }
}
