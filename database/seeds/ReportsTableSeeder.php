<?php

use Illuminate\Database\Seeder;
use Hifone\Models\Report;
class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
    factory(Report::class, 10)->create();
}
}
