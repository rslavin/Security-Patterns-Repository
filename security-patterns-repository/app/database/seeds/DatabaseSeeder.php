<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('CweTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
        	'firstname' => 'Jean-Michel',
        	'lastname' => 'Lehker',
        	'email' => 'j.lehker@gmail.com',
        	'password' => Hash::make('secret1')
        ));
        User::create(array(
        	'firstname' => 'Rocky',
        	'lastname' => 'Slavin',
        	'email' => 'rslavin@gmail.com',
        	'password' => Hash::make('secret1')
        ));
        User::create(array(
        	'firstname' => 'Jianwei',
        	'lastname' => 'Niu',
        	'email' => 'jianwein@gmail.com',
        	'password' => Hash::make('secret1')
        ));
    }

}

class CweTableSeeder extends Seeder {
	public function run() {
		DB::table('cwe_set')->delete();
		DB::table('cwe')->delete();
		
		$set = CweSet::create(array('pattern_id' => 98));
		
		Cwe::create(array('name' => 'fakeCwe1', 'cwe_set_id' => $set->id));
		
		Cwe::create(array('name' => 'fakeCwe2', 'cwe_set_id' => $set->id));
		
		
	}
	
}