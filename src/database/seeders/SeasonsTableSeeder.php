<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '春',
            'created_at' => Carbon::now(),
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'name' => '夏',
            'created_at' => Carbon::now(),
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'name' => '秋',
            'created_at' => Carbon::now(),
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'name' => '冬',
            'created_at' => Carbon::now(),
        ];
        DB::table('seasons')->insert($param);
    }
}
