<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
		foreach (range(1,20) as $index) {
		DB::table('mahasiswas')->insert([
		'NRP' => $faker->randomNumber(7) ,
		'Nama' => $faker->name,
		'email' => $faker->email,
		'created_at' => $faker->dateTime($max = 'now'),
		'updated_at' => $faker->dateTime($max = 'now'),
		]);
      }
    }
}
