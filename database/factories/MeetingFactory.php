<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeThisMonth('+10 days'),
            'time' => $this->faker->time(),
            'place' => $this->faker->streetAddress(),
            'status_id' => Status::all()->first->id,
            'admin_abogado_id' => User::role('abogado admin')->get()->first->id,
            'abogado_id' => User::role('abogado')->get()->first->id,
        ];
    }
}
