<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\User;
use App\Models\PartChange;
use Illuminate\Database\Seeder;

class PartChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $part = Part::where('meeting_id', 1)
            ->where('role', 'arrendatario')
            ->first();
        
        $oldPartId = $part->part_id;

        $part->part_id = User::role('arrendatario')
            ->orderBy('id', 'desc')
            ->first()
            ->id;
        $part->save();

        PartChange::create([
            'part_id' => $part->id,
            'reason' => 'Se cambio el asignatario...',
            'old_user_id' => $oldPartId,
            'new_user_id' => $part->part_id,
            'role' => 'arrendatario'
        ]);
    }
}
