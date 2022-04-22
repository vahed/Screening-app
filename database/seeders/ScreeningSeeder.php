<?php

namespace Database\Seeders;

use App\Models\Screening;
use Illuminate\Database\Seeder;

class ScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Screening::factory()->times(50)->create();
    }
}
