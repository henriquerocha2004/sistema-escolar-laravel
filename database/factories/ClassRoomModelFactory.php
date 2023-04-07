<?php

namespace Database\Factories;

use App\Models\ClassRoomModel;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassRoomModel>
 */
class ClassRoomModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'identification' => 'TU-' . $this->faker->randomNumber(3),
            'number_of_vacancies' => $this->faker->randomNumber(2),
            'shift' => $this->faker->randomElement(ShiftEnum::all()),
            'level' => '2 ANO',
            'localization' => null,
            'vacancies_occupied' => $this->faker->randomNumber(1),
            'status' =>  $this->faker->randomElement(ClassRoomStatusEnum::all()),
            'open_date' => date('Y-m-d H:i:s'),
        ];
    }
}
