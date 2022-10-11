<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\User;
use App\Models\Meeting;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meeting1 = Meeting::find(1);

        Part::create([
            'meeting_id' => $meeting1->id,
            'part_id' => User::role('arrendador')->first()->id,
            'role' => 'arrendador',
        ]);

        Part::create([
            'meeting_id' => $meeting1->id,
            'part_id' => User::role('arrendatario')->first()->id,
            'role' => 'arrendatario',
        ]);

        Part::create([
            'meeting_id' => $meeting1->id,
            'part_id' => User::role('solidario')->first()->id,
            'role' => 'solidario',
        ]);

        Part::create([
            'meeting_id' => $meeting1->id,
            'part_id' => User::role('fiador')->first()->id,
            'role' => 'fiador',
        ]);
    }
}
