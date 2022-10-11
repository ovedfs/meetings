<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'programada']);
        Status::create(['name' => 'reagendada']);
        Status::create(['name' => 'cancelada']);
        Status::create(['name' => 'confirmada']);
        Status::create(['name' => 'completada']);
    }
}
