<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('en_IN');
    	foreach(range(1,3000) as $index){
	    	$employee = \App\Employee::insert([
	            'name' => $faker->name,
	            'address' => $faker->address,
	            'contact' => $faker->e164PhoneNumber,
	            'gender' => $faker->randomElement($array = array ('male', 'female')),
	            'date_of_joining' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'email' => $faker->unique()->email,
	        ]);
	    }
    }
}
