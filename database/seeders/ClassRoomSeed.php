<?php

namespace Database\Seeders;

use App\Models\ClassRoomModel;
use Illuminate\Database\Seeder;

class ClassRoomSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassRoomModel::factory()->count(1000)->create();
    }
}
