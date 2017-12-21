<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hifone\Models\Thread;
use Hifone\Models\User;
use Hifone\Models\Report;

$factory->define(User::class, function ($faker) {
    return [
        'username'       => $faker->name,
        'email'          => $faker->email,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Thread::class, function ($faker) {
    return [
        'user_id'      => 1,
        'title'        => $faker->text,
        'body'         => $faker->text,
        'node_id'      => 1,
		'points'       => 1,
    ];
});

$factory->define(Report::class, function ( $faker) {
    return [
        
        'url' => $faker->url,
        'reporter' => 1,
        'reported' => 1,
       'url' => $faker->text,
    ];
});

$factory->define(Message::class, function ($faker) {
    return [
        'msg_from' => 1,
        'msg_to' => 1,
        'text' => $faker->text,
       
    ];
});

$factory->define(Block::class, function ( $faker) {
    return [
         'blocker' => 1,
        'blocked' => 1,
		 'active' => 1,
        
    ];
});

$factory->define(Visit::class, function (Generator $faker) {
    return [
        'id' => 1,
		'visitor' => 1,
        'visited' => 1,
        'date' => $faker->date,
       
    ];
	
	
$factory->define(Following::class, function (Generator $faker) {
    return [
        'id' => 1,
		'follower' => 1,
        'followed' => 1,
        'date' => $faker->date,
    ];
	
	
	
});
	
	
});