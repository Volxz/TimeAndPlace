<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'code' => 'P1',
            'start' => '8:30',
            'end' => '9:50',
            'altstart' => '8:30',
            'altend' => '9:35',           
        ]);
	    DB::table('schedules')->insert([
            'code' => 'P2',
            'start' => '10:00',
            'end' => '11:15',
            'altstart' => '9:40',
	        'altend' => '11:50',            
        ]);
	    DB::table('schedules')->insert([
            'code' => 'LUNCH',
            'start' => '11:15',
            'end' => '12:05',
            'altstart' => '11:50',
            'altend' => '12:35',
        ]);
	    DB::table('schedules')->insert([
            'code' => 'P4',
            'start' => '12:05',
            'end' => '13:20',
            'altstart' => '12:35',
            'altend' => '13:35',
        ]);
	    DB::table('schedules')->insert([
            'code' => 'P5',
            'start' => '13:25',
            'end' => '14:40',
            'altstart' => '13:40',
            'altend' => '14:40',
        ]);
        /* Now create 5 minute interval times */
        for($hours=0; $hours<24; $hours++) {
		    for($mins=0; $mins<60; $mins+=5) {
                $fiveMin = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT). PHP_EOL;
                DB::table('schedules')->insert([
                    'code' => $fiveMin,
                    'start' => '00:00',
                    'end' => $fiveMin,
                    'altstart' => '00:00',
                    'altend' => $fiveMin,
                ]);
            }
        }

    }
}
