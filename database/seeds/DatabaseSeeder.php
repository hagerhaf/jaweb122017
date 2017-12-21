<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(ReportsTableSeeder::class);
	  $this->call(MessagesTableSeeder::class);
	  $this->call(BlocksTableSeeder::class);
	  $this->call(VisitsTableSeeder::class);
	  $this->call(FollowingsTableSeeder::class);
	  $this->call(ThreadsTableSeeder::class);
	   $this->call(RepliesTableSeeder::class);
    }
}