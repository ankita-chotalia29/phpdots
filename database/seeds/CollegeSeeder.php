<?php

use Illuminate\Database\Seeder;
use App\College;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleges = ['Adrian Collge','KSV Collge','VVP College','LD College'];
        foreach ($colleges as $value) {
	    	College::create([
	            'college_name' => $value,
	        ]);
    	}
    }
}
